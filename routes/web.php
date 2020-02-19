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
    return view('layouts.app');
});

Auth::routes();

// Route::resource('employees', 'EmployeeController');

Route::get('empDataTable', 'EmployeeController@getEmployees')->name('dt.emp');

Route::get('employees', 'EmployeeController@index');
Route::post('employees', 'EmployeeController@update');
Route::get('appDataTable', 'EmployeeController@getApps')->name('dt.app');