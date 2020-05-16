(function(){
    'use strict';
    angular
        .module('crudapp')
        .controller('EmployeesCtrl', EmployeesCtrl)
        .controller('CreateEmployeesCtrl', CreateEmployeesCtrl)
        .controller('EditEmployeesCtrl', EditEmployeesCtrl)

        EmployeesCtrl.$inject = ['EmployeesSrvcs', '$scope', '$stateParams', '$state', '$uibModal', '$window', '$rootScope', '$compile', 'DTOptionsBuilder', 'DTColumnBuilder', 'SweetAlert'];
        function EmployeesCtrl(EmployeesSrvcs, $scope, $stateParams, $state, $uibModal, $window, $rootScope, $compile, DTOptionsBuilder, DTColumnBuilder, SweetAlert){
            var vm = this;
            var data = {};
 

            vm.is_loader_disabled = false;
            vm.is_submit_disabled = false;

            // vm.getEmployees = (id) => {
            //     return new Promise(resolve => {
            //         EmployeesSrvcs.list({id:id}).then (function (response) {
            //             if(response.data.status == 200)
            //             {
            //                 resolve(response.data.data[0]);
            //             }
            //         }, function (){ alert('Bad Request!!!') })
            //     });
            // };

            // vm.init = async (id) => {
            //     const data = await vm.getEmployees(id);
            //     $scope.$apply(() => vm.employees = {
            //         ...data
            //     });
            // };

            // vm.init('');

            EmployeesSrvcs.list({id:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.employees = response.data.data;
                    vm.employee_count = response.data.count;
                    console.log(vm.employees)
                }
            }, function (){ alert('Bad Request!!!') })

            
            //render dtables here

            vm.editEmployee = function(id){
 
                alert(id)

                EmployeesSrvcs.list({id:id}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.employee = response.data.data[0];

                        $uibModal.open({
                            templateUrl: 'edit-employee-modal',
                            controller: 'EditEmployeesCtrl',
                            controllerAs: 'EmployeesCtrl',
                            backdrop: 'static',
                            keyboard  : false,
                            resolve :{
                                collection: function () {
                                    return {
                                        data: vm.employee
                                    };
                                }
                            },
                            // size: 'lg'
                        });
                        
                    }
                }, function (){ alert('Bad Request!!!') })

               

            }

            vm.deleteEmployee = function(code){
 
                alert(code)

            }

            vm.renderActions = function(data) {
                return ' <a href="#" ng-click="EmployeesCtrl.editEmployee(\'' + data + '\');"> edit </a> | <a href="#" ng-click="EmployeesCtrl.deleteEmployee(\'' + data + '\');"> delete </a>';
            }


            vm.dtOptions = DTOptionsBuilder.newOptions()
                .withOption('ajax', {
                // Either you specify the AjaxDataProp here
                // dataSrc: 'data',
                url: 'api/v2/employees',
                type: 'GET'
            })
            // or here
            .withDataProp('data')
                .withOption('processing', true)
                .withOption('serverSide', true)
                .withPaginationType('full_numbers');
            vm.dtColumns = [ 
                DTColumnBuilder.newColumn('id').withTitle('ID'),
                DTColumnBuilder.newColumn('lastname').withTitle('Last name'),
                DTColumnBuilder.newColumn('suffix').withTitle('Suffix'),
                DTColumnBuilder.newColumn('firstname').withTitle('First name'),
                DTColumnBuilder.newColumn('middlename').withTitle('Middle name'),
                DTColumnBuilder.newColumn('id').withTitle('Actions').renderWith(vm.renderActions)
                .withOption('createdCell', function(cell, cellData, rowData, rowIndex, colIndex) {
                    $compile(angular.element(cell).contents())($scope);
                }), 
                
            ];

            vm.newEmployeeBtn = ()=>{
                
                $uibModal.open({
                    templateUrl: 'add-employee-modal',
                    controller: 'CreateEmployeesCtrl',
                    controllerAs: 'EmployeesCtrl',
                    backdrop: 'static',
                    keyboard  : false,
                    resolve :{
                        collection: function () {
                            return {
                                data: null
                            };
                        }
                    },
                    // size: 'lg'
                });
            }

            vm.deleteEmployee = (id)=>{
                SweetAlert.swal({
                    title: "Are you sure you want to delete this record?",
                    text: "sample text",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (!isConfirm) {
                        SweetAlert.swal("Cancelled!", "", "error");
                        
                    } else {

                        EmployeesSrvcs.remove({id:id}).then ( (response)=> {
                            if(response.data.status == 200){
                                SweetAlert.swal("Success!", "This record has been deleted.", "success");
                                $state.reload();
                            }else{
                                SweetAlert.swal("Error!", "Bad request!.", "error");
                            }
                        },()=>{ alert('Bad Request!!!') })
                    }
                });
            }

            vm.routeTo = function(route){
                $window.location.href = route;
            }; 
            
        }


        CreateEmployeesCtrl.$inject = ['EmployeesSrvcs', '$state', '$stateParams', '$uibModal', '$uibModalInstance', '$window', 'SweetAlert'];
        function CreateEmployeesCtrl(EmployeesSrvcs, $state, $stateParams, $uibModal, $uibModalInstance, $window, SweetAlert){
            var vm = this;
            var data = {};

            vm.createEmployeeBtn = (data)=>{
                
                EmployeesSrvcs.store(data).then (function (response) {
                    if(response.data.status == 200){
                        // alert('Successfully Saved!')
                        SweetAlert.swal("Success!", "Successfully saved!", "success");
                        $state.reload();
                        vm.close()
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.close = function() {
                $uibModalInstance.close();
            };

        }

        EditEmployeesCtrl.$inject = ['collection', 'EmployeesSrvcs', '$state', '$stateParams', '$uibModal', '$uibModalInstance', '$window', 'SweetAlert'];
        function EditEmployeesCtrl(collection, EmployeesSrvcs, $state, $stateParams, $uibModal, $uibModalInstance, $window, SweetAlert){
            var vm = this;
            var data = {};

            vm.collection = collection.data;
            console.log(vm.collection)

            vm.updateEmployeeBtn = (data)=>{
                
                EmployeesSrvcs.update(data).then (function (response) {
                    if(response.data.status == 200){
                        // alert('Successfully Updated!')
                        SweetAlert.swal("Success!", "Successfully updated!", "success");
                        $state.reload();
                        vm.close()
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.close = function() {
                $uibModalInstance.close();
            };

        }

})();