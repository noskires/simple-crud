(function(){
    'use strict';
    angular.module('crudapp',[
          'ui.router',
          'ngSanitize',
          'dynamicNumber',
          'ui.bootstrap',
          'datatables',
          'chart.js',
          'oitozero.ngSweetAlert'
        ])
        .config(Config)
        .controller('MainCtrl', MainCtrl)

        Config.$inject = ['$stateProvider', '$urlRouterProvider', '$locationProvider', '$controllerProvider', '$compileProvider', '$filterProvider', '$provide', '$interpolateProvider', 'dynamicNumberStrategyProvider', 'ChartJsProvider'];
        function Config($stateProvider, $urlRouterProvider, $locationProvider, $controllerProvider, $compileProvider, $filterProvider, $provide, $interpolateProvider, dynamicNumberStrategyProvider, ChartJsProvider){
            console.log("App here!");
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
            $locationProvider.html5Mode(true);

            ChartJsProvider.setOptions({ colors : [ '#DCDCDC', '#46BFBD', '#FDB45C', '#949FB1', '#4D5360', '#803690', '#00ADF9'] });

            var main = {
                url: '/index',
                templateUrl: 'main.view'
            };
            
            $stateProvider
            .state('main-view', main)

            .state('employees', {
                url: '/employees',
                controller: 'EmployeesCtrl as EmployeesCtrl',
                templateUrl: 'employees.view'
            })

            .state('employee-details', {
                url: '/employee/:id/:actionType',
                controller: 'EmployeesCtrl as EmployeesCtrl',
                templateUrl: 'employees.view'
            })

            $urlRouterProvider.otherwise('/index');

        }

        MainCtrl.$inject = ['$window','$http', '$stateParams', '$state'];
        function MainCtrl($window, $http, $stateParams, $state) {
            var vm = this;

            vm.routeTo = function(route){
                $window.location.href = route;
            };
        };
})();


 