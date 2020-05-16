<nav class="navbar navbar-expand-lg main-navbar">
<a href="index.html" class="navbar-brand sidebar-gone-hide">Sample Crud</a>
<a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
<div class="nav-collapse">
    <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
    <i class="fas fa-ellipsis-v"></i>
    </a>
</div>
 
<form class="form-inline ml-auto">
 
</form>

<ul class="navbar-nav navbar-right">
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
  
    <img alt="image" src="public/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
 
    <div class="d-sm-none d-lg-inline-block">Hi, Administrator</div></a>
    <div class="dropdown-menu dropdown-menu-right">
        <a href="features-profile.html" class="dropdown-item has-icon">
        <i class="far fa-user"></i> Profile
        </a>
        <a href="features-activities.html" class="dropdown-item has-icon">
        <i class="fas fa-bolt"></i> Change Passord
        </a>
        <a href="features-settings.html" class="dropdown-item has-icon">
        <i class="fas fa-cog"></i> Settings
        </a>
  
    </li>
</ul>
</nav>

<nav class="navbar navbar-secondary navbar-expand-lg">
<div class="container">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="dashboard.html" class="nav-link"><i class="far fa-chart-bar"></i><span>Employees</span></a>
        </li>
    </ul>
</div>
</nav>

<!-- Main Content -->
<div class="main-content">
<section class="section">
    <div class="section-header">
        <h1>Employees</h1>
        <div class="section-header-breadcrumb"></div>
    </div>

    <div class="section-body">
        <div id="cover-spin" ng-if="EmployeesCtrl.is_loader_disabled"></div>

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4></h4>
                        <div class="card-header-action">
                            <a href="#" class="btn btn-icon icon-left btn-primary" ng-click="EmployeesCtrl.newEmployeeBtn()"><i class="far fa-edit"></i> Add new employee</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                                Using Server Side Ajax:
                                <table datatable="" dt-options="EmployeesCtrl.dtOptions" dt-columns="EmployeesCtrl.dtColumns" class="table table-bordered table-hover table-md" ></table>
                                <br>
                                <br>
                                <br>
                                <hr>
                                <br>
                                <br>
                                <br>
                                Using Simple dtables:
                                <table class="table table-bordered table-hover table-md" datatable="ng">
                                    <thead>
                                        <tr>
                                            <th>Last Name</th>
                                            <th>Suffix</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="employee in EmployeesCtrl.employees">
                                            <td><%employee.lastname%></td>
                                            <td><%employee.suffix%></td>
                                            <td><%employee.firstname%></td>
                                            <td><%employee.middlename%></td>
                                            <td>
                                                <a href="#" ng-click="EmployeesCtrl.editEmployee(employee.id)"> edit </a> | 
                                                <a href="#" ng-click="EmployeesCtrl.editEmployee(employee.id)"> delete </a>
                                            </td>
                                        </tr> 
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/ng-template" id="add-employee-modal">

    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Employee Details</h5>
            <button type="button" class="close" ng-click="EmployeesCtrl.close()">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

        <br>
            <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Lastname</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Lastname" ng-model="EmployeesCtrl.collection.lastname">
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Suffix</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Suffix" ng-model="EmployeesCtrl.collection.suffix">
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Firstname</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Firstname" ng-model="EmployeesCtrl.collection.firstname">
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Middlename</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Middlename" ng-model="EmployeesCtrl.collection.middlename">
                </div>
            </div>
    
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" ng-click="EmployeesCtrl.close()">Close</button>
                <button type="button" class="btn btn-primary" ng-click="EmployeesCtrl.createEmployeeBtn(EmployeesCtrl.collection)">Save changes</button>
               
            </div>
    </div>

</script>

<script type="text/ng-template" id="edit-employee-modal">

    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Employee Details</h5>
            <button type="button" class="close" ng-click="EmployeesCtrl.close()">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

        <br>
            <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Lastname</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Lastname" ng-model="EmployeesCtrl.collection.lastname">
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Suffix</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Suffix" ng-model="EmployeesCtrl.collection.suffix">
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Firstname</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Firstname" ng-model="EmployeesCtrl.collection.firstname">
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Middlename</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Middlename" ng-model="EmployeesCtrl.collection.middlename">
                </div>
            </div>
    
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" ng-click="EmployeesCtrl.close()">Close</button>
                <button type="button" class="btn btn-primary" ng-click="EmployeesCtrl.updateEmployeeBtn(EmployeesCtrl.collection)">Update changes</button>
            </div>
    </div>

</script>


