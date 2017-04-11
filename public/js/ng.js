/**
 * Created by Peace Ngara on 4/9/2017.
 * Angular Search and Filter
 * This Implementation uses Angular to query a RESTFul API Service and Return Results
 */

var notebooks = angular.module('tools', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

notebooks.controller('ToolsListCtrl', function($scope, $http) {
    $scope.tools = [];
    $scope.loading = false;

    $scope.init = function () {
        $scope.loading = true;
        var currenturi = window.host;
        console.log(currenturi);
        $http.get('/eon/lti/ngappstore').
            success(function (data, status, headers, config) {
            $scope.tools = data;
             $scope.loading = false;
        });
    };

    $scope.orderList = "title";
    $scope.init();
});