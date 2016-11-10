<!doctype html>
<html ng-app="App" >
    <head>
        <title>BrainSwag</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

        <link rel="stylesheet" type="text/css" href="../css/all_genes.css">

        <script>document.write("<base href=\"" + document.location + "\" />");</script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.2/angular.js"></script>
        <script src="../js/all_genes.js" type="text/javascript"></script></script>  
</head>
<body ng-controller="omicsCtrl">
    <h3>All genes metadata</h3>
    <br>
    <label>Search :  <input type="search" ng-model="q" placeholder="type name or ID or symbol or sample ..."></label>
    <form method="GET" action="gene_preview.php"> 
        <table class="table table-striped table-condensed table-hover">
            <tr id="head">
                <td><p>Name</p></td>
                <td>ID</td>
                <td>Symbol</td>
                <td>Sample</td>
            </tr>
            <tr ng-repeat="(x,data) in omics | filter:q"> 
                <td> {{data.Name}} </td>
                <td >{{data.ID}}</td>
                <td>{{data.Symbol}}</td>
                <td>{{data.Species}}</td>
                <td><a href="gene_preview.php?ID={{data.ID}}"><img src="../img/plus.png" class="img-circle">More details</a><td width="50%"></td>
            </tr>
        </table>
    </form> 
</body>
</html>