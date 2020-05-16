(function(){
    'use strict';
    angular
        .module('crudapp')
        .factory('EmployeesSrvcs', EmployeesSrvcs)
        EmployeesSrvcs.$inject = ['$http'];
        function EmployeesSrvcs($http) {
            return {
                list: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: 'api/v1/employees?id='+data.id,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                store: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/employee/store',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/employee/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                remove: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/employee/remove',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                }

            };
        }
})();