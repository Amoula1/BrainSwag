var App = angular.module('App', []);

App.controller('omicsCtrl', function ($scope, $http) {
    $http.get('../json/all_genes.json')
            .then(function (res) {
                $scope.omics = res.data;
            });
});



