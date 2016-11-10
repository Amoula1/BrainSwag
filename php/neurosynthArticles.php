<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body onload="loadpage()">

    </body>
</html>
<script type="text/javascript">
    function loadpage() {
        var req = new XMLHttpRequest();
        req.open('GET', 'http://brainspell.org/search?query=17012294', false);
        req.send(null);
        if (req.status == 200)
            dump(req.responseText);

        var ua = navigator.userAgent.toLowerCase();
        if (!window.ActiveXObject)
            req = new XMLHttpRequest();
        else if (ua.indexOf('msie 5') == -1)
            req = new ActiveXObject("Msxml2.XMLHTTP");
        else
            req = new ActiveXObject("Microsoft.XMLHTTP");
        alert("Page is loaded");
    }

</script>