<div class="subsection home">
    <h3 style="padding-bottom:3rem;line-height:150%"><b>Welcome to BrainSwag!</b> Description of the aim of the brainswag project here !.</h3>
</div>

<div class="subsection home">
    <form method="post" action="#">
        <fieldset id="home-search">
            <input type="text" name="query" id="search" placeholder="Search articles by title, author, keywords"/>
            <input type="submit" name="submit"  value="Search in Brainspell" class="button_active">	
        </fieldset>     
    </form>
</div>

<div class="subsection home">
    <ul class="paper-list">
    </ul>
</div>
<?php

// MOVE IN A SEPARATE FILE THIS CLASS 
class Article {

    public $pmid;
    public $doi;
    public $title;
    public $location;

    function __construct() {
        $this->location = array();
    }

    public function setLocations($tabLocations) {
        foreach ($tabLocations as $key => $value) {
            $this->location[] = $value;
        }
    }

    public function setPmid($_pmid) {
        $this->pmid = $_pmid;
    }

    public function setDoi($_doi) {
        $this->doi = $_doi;
    }

    public function setTitle($_title) {
        $this->title = $_title;
    }

    //getters
    public function getTitle() {
        return $this->title;
    }

    public function getPmid() {
        return $this->pmid;
    }

    public function getDoi() {
        return $this->doi;
    }

    public function getLocations() {
        foreach ($this->location as $key => $value) {
            print_r($value);
            echo '<br>';
        }
    }

}

//get pmid from DOM
require_once "simple_html_dom.php";
$html1 = new simple_html_dom();
//get input data

if (isset($_POST['query'])) {
    $query = $_POST['query'];
    echo "My query is : " . $query;
    echo '<br>';

    $html1->load_file('http://brainspell.org/search?query=' . $query . '');
    $pmids = array();
    echo "All the pmid's papers associated to the query ";
    echo '<br>';
    foreach ($html1->find('.paper-stuff') as $article) {
        $pmids[] = str_replace("/article/", "", $article->find('a', 0)->getAttribute('href'));
        foreach ($pmids as $key => $element) {
            echo $element;
            echo '<br>';
        }
    }

    $searched_papers = array();
//upload all data 
    $json = file_get_contents("C:\wamp\www\BrainSwag\BrainSwag\json\AllArticles.json");
    $data = json_decode($json, true);
    foreach ($pmids as $key => $pmid) {
        foreach ($data as $key => $paper) {          
            if (strcasecmp(trim($paper["pmid"]),trim($pmid)) ==0 ) {
                echo "- Pmid=" . $pmid;
                echo '<br>';
                $paperMetadata = new Article();
                $paperMetadata->setPmid($paper["pmid"]);
                $paperMetadata->setDoi($paper["doi"]);
                $paperMetadata->setTitle($paper["title"]);
                //xyz
                $locationsXYZ = array();
                foreach ($paper['experiment']as $key => $value1) {
                    $locationsXYZ[] = $value1;
                    //print_r($locationsXYZ);
                }
                $paperMetadata->setLocations($locationsXYZ);
                // store 
                $searched_papers[] = $paperMetadata;
            }
        }
    }
    print_r($searched_papers);
}
?>