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
})->name('login.page');

Auth::routes();

// Route::resource('employees', 'EmployeeController');

Route::get('empDataTable', 'EmployeeController@getEmployees')->name('dt.emp');

Route::get('employees', 'EmployeeController@index')->name('employees');
Route::post('employees/add', 'EmployeeController@store')->name('add.user');
Route::get('employees/add','EmployeeController@create')->name('create.user');
Route::post('employees', 'EmployeeController@update');
Route::get('appDataTable', 'EmployeeController@pluckApps')->name('pluck.app');
Route::get('change-password', 'EmployeeController@changePasswordIndex');
Route::post('change-password', 'EmployeeController@changePass');
Route::post('reset-password', 'EmployeeController@resetPass');
Route::get('organization', 'ProcessController@index')->name('organization');
Route::get('organization/{id}','ProcessController@showEmp')->name('show.users');
// Route::post('organization/add-user','EmployeeProcess@newRecord')->name('store.empProcess');
// Route::post('applist/delete','AppController@delete')->name('delete.app');

Route::resource('employeeProcess', 'EmployeeProcessController');
Route::resource('apps', 'AppController');

Route::get('preview-emails', function () {
    $message = (new \App\Notifications\ResetPassword(\App\Models\Employee::find(1)))->toMail('test@test.com');
    return $message->render();
}); //to preview Reset Password email. change $emp->tempPass @ App\Notifications\ResetPassword