function hideFunction() {
    document.getElementById("viewOther").style.visibility = "hidden";
}

function hideTissue() {
    document.getElementById("tissue").style.visibility = "hidden";
}

function hideSample() {
    document.getElementById("sample").style.visibility = "hidden";
}

function hideTissueType() {
    document.getElementById("tissueType").style.visibility = "hidden";
}
function hideBrain() {
    document.getElementById("brain").style.visibility = "hidden";
}
function hideOtherBrain() {
    document.getElementById("otherBrain").style.visibility = "hidden";
}
function hideOtherHuman() {
    document.getElementById("otherHuman").style.visibility = "hidden";
}
function hideOtherExpName() {
    document.getElementById("otherExpName").style.visibility = "hidden";
}
function hideC() {
    document.getElementById("concentration").style.visibility = "hidden";
}
function showFunction() {
    document.getElementById("viewOther").style.visibility = "visible";
}

function otherSample() {
    document.getElementById("sample").style.visibility = "visible";
}

function showTissue() {
    document.getElementById("tissue").style.visibility = "visible";
}
function otherTissueType() {
    document.getElementById("tissueType").style.visibility = "visible";
}
function showBrain() {
    document.getElementById("brain").style.visibility = "visible";
}
function otherBrain() {
    document.getElementById("otherBrain").style.visibility = "visible";
}
function otherHuman() {
    document.getElementById("otherHuman").style.visibility = "visible";
}
function otherExpName() {
    document.getElementById("otherExpName").style.visibility = "visible";
}
function concentration() {
    document.getElementById("concentration").style.visibility = "visible";
}

function otherExpM() {
    document.getElementById("otherExpM").style.visibility = "visible";
}

var app = angular.module('app_omics', []);
app.controller('ctrl_omics', function ($scope) {
    $scope.showMeProteomics = function () {
        if ($scope.data.omics == 'Proteomics')
            return true;
    }
    $scope.showMeGeomics = function () {
        if ($scope.data.omics == 'Geomics')
            return true;

    }
    $scope.showMeMetabolomics = function () {
        if ($scope.data.omics == 'Metabolomics')
            return true;
    }
    $scope.showMeForm = function () {
        if ($scope.data.omics == 'Proteomics' || $scope.data.omics == 'Geomics' || $scope.data.omics == 'Metabolomics')
            return true;
    }
    $scope.save = function () {
        $http.post('../json/all_genes.json', $scope.data).then(function (data) {
            $scope.msg = 'Data saved';
        });
        $scope.msg = 'Data sent: ' + JSON.stringify($scope.data);
    };
});
