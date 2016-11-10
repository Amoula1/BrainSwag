<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include $_SERVER['DOCUMENT_ROOT'] . "/php/base.php";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, "brainspell") or die("MySQL Error 1: " . mysql_error());

if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
    }
}
function strip_cdata($str) {
    return preg_replace('/<!\[CDATA\[(.*)\]\]>/', '$1', $str);
}
function home() {
    global $dbname;
    global $connection;

    $html = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/templates/base_adapted.html");
    $home = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/templates/home_adapted.html");
    $tmp = str_replace("<!--Core-->", $home, $html);
    $html = $tmp;

    $result = mysqli_query($connection, "SELECT COUNT(*) FROM Articles");
    $count = mysqli_fetch_assoc($result);
    $tmp = str_replace("<!--NumberOfArticlesIndexed-->", $count["COUNT(*)"], $html);
    $html = $tmp;
    $html = $tmp;
    print $html;
}
/*The most useful function*/
function search_lucene($query) {
    global $connection;
    $html = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/templates/base_adapted.html");
    $search = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/templates/search_adapted.html");
    $tmp = str_replace("<!--Core-->", $search, $html);
    $html = $tmp;

    $index = getIndex_lucene();

    $hits = $index->find($query);
    if (!empty($hits)) {
        // list article references
        $str = '<table class="paper-list">';
        foreach ($hits as $hit) {
            $str.="<tr class='paper-stuff'>\n";
            $str.="<td><input type='checkbox'></td>";
            $str.="<td><h3><a href=\"" . "/article/" . $hit->PMID . "\">";
            $str.=$hit->Title . "</a></h3>\n";
            $str.="<p class=\"info\">" . $hit->Reference . " (" . sprintf("%.0f", $hit->score * 100) . "%)</p>\n";
            $str.="</td></tr>\n";
        }
        $str = $str . "</table>\n";
    } else
        $str = "<p>The search <b>" . $query . "</b> did not match any articles.</p>";

    $qstr = htmlentities(stripslashes($query));
    $tmp = str_replace("<!--%SearchString%-->", $qstr, $html);
    $html = $tmp;

    $number = count($hits);
    $multiplicity = (count($hits) > 1) ? "s" : "";
    $info = $number . " article" . $multiplicity . " corresponding to the search \"" . $qstr . "\"";

    $tmp = str_replace("<!--%SearchResultsInfo%-->", $info, $html);
    $html = $tmp;

    $tmp = str_replace("<!--%SearchResults%-->", stripslashes($str), $html);
    $html = $tmp;

    if (isset($_SESSION['Username']))
        $tmp = str_replace("<!--Username-->", $_SESSION['Username'], $html);
    else
        $tmp = str_replace("<!--Username-->", "", $html);
    $html = $tmp;

    if (isset($_SESSION['LoggedIn']))
        $tmp = str_replace("<!--LoggedIn-->", $_SESSION['LoggedIn'], $html);
    else
        $tmp = str_replace("<!--LoggedIn-->", "0", $html);
    $html = $tmp;

    print $html;
}
function getIndex_lucene() {
    $dir = $_SERVER['DOCUMENT_ROOT'] . "/php/";
    chdir($dir);
    require_once 'Zend/Loader/Autoloader.php';
    require_once 'StandardAnalyzer/Analyzer/Standard/English.php';
    $loader = Zend_Loader_Autoloader::getInstance();
    $loader->setFallbackAutoloader(true);
    $loader->suppressNotFoundWarnings(false);

    Zend_Search_Lucene_Analysis_Analyzer::setDefault(new StandardAnalyzer_Analyzer_Standard_English());

    $path = $_SERVER['DOCUMENT_ROOT'] . "/php/LuceneIndex";
    try {
        $indx = Zend_Search_Lucene::open($path);
    } catch (Zend_Search_Lucene_Exception $e) {
        try {
            $indx = Zend_Search_Lucene::create($path);
        } catch (Zend_Search_Lucene_Exception $e) {
            echo "<p>Impossible to open an index at " . $path . " " . $e->getMessage() . "</p>";
            exit(1);
        }
    }
    return $indx;
}
?>
