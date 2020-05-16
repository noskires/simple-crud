<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// -- EMPLOYEES -- //
Route::get('/employees','EmployeesController@index');

// -- EMPLOYEES API -- //
Route::get('/api/v1/employees','EmployeesController@show');
Route::get('/api/v2/employees','EmployeesController@show2');
Route::get('/api/v1/employees/{id}','EmployeesController@show');
Route::post('/api/v1/employee/store','EmployeesController@store');
Route::post('/api/v1/employee/update','EmployeesController@update');
Route::post('/api/v1/employee/remove','EmployeesController@remove');
