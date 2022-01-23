<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LeaveController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\SickLeaveController;
use Illuminate\Support\Facades\Auth;

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
    return redirect()->route('admin.dashboard');
});
// Route::get('/profile', function () {
//     return 'hi';
// });
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



 Route::prefix('admin')->middleware('admin')->namespace('App\\Http\\Controllers\\Admin')->group(function () {

    // Route::prefix('admin')->namespace('App\\Http\\Controllers\\Admin')->group(function () {
    Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');
Route::get('employees', 'AdminController@employees')->name('admin.employees');
Route::get('department', 'AdminController@department')->name('admin.department');
Route::get('employee/create', 'AdminController@employeeCreate')->name('admin.employees.create');
Route::get('employee/{id}/view', 'AdminController@employeeView')->name('admin.employees.view');
Route::get('employee/{id}/edit', 'AdminController@employeeEdit')->name('admin.employees.edit');
Route::get('employee/{id}/delete', 'AdminController@employeeDestroy')->name('admin.employees.delete');
// Route::get('employee/{id}/show', 'AdminController@employeeShow')->name('admin.employees.show');
Route::post('employee/{id}/update', 'AdminController@employeeUpdate')->name('admin.employeeUpdate');
Route::post('employees', 'AdminController@employeeStore')->name('admin.employeeStore');
Route::get('attendance_history', 'AdminController@attendance_history')->name('admin.attendance_history');
Route::get('attent_status_disapprove/{id}', 'AdminController@attent_status_disapprove')->name('admin.attent_status_disapprove');
Route::get('attent_status_approve/{id}', 'AdminController@attent_status_approve')->name('admin.attent_status_approve');

Route::post('add_department', 'AdminController@add_department')->name('admin.add_department');
Route::get('depart_status_deactive/{id}', 'AdminController@depart_status_deactive')->name('admin.depart_status_deactive');
Route::get('depart_status_active/{id}', 'AdminController@depart_status_active')->name('admin.depart_status_active');
Route::get('delete_department/{id}', 'AdminController@delete_department')->name('admin.delete_department');
Route::post('edit_department/{id}', 'AdminController@edit_department')->name('admin.edit_department');
///Profile Section /////////////
// Route::post('profile', 'AdminController@profile')->name('profile');
Route::get('update_profile', 'AdminController@update_profile')->name('admin.update_profile');


Route::view('/add_threshold','Admin/add_threshold');
Route::view('/add_threshold','Admin/add_threshold');
Route::post('/add/deduction','AdminController@create_deduction')->name('add.deduction');


Route::get('/updateThreshold','AdminController@updateThreshold')->name('update.threshold');



Route::get('/threshold',[AdminController::class,'threshold']);
Route::post('/add_threshold',[AdminController::class,'add_threshold']);
Route::get('/edit_threshold/{id}',[AdminController::class,'edit_threshold']);
Route::post('/update_threshold/{id}',[AdminController::class,'update_threshold']);
Route::get('/delete_threshold/{id}',[AdminController::class,'delete_threshold']);
//////////////////leave section //////////////////////
///////sick leave start
Route::get('/sick-leave',[LeaveController::class,'sick_leave']);
Route::post('/insert_sick_leave',[LeaveController::class,'insert_sick_leave']);
Route::get('/sick_status_deactive/{id}',[LeaveController::class,'sick_status_deactive']);
Route::get('/sick_status_active/{id}',[LeaveController::class,'sick_status_active']);
Route::get('/delete_sick/{id}',[LeaveController::class,'delete_sick']);
///////sick leave end
///////vacation leave start
Route::get('/vacation-leave',[LeaveController::class,'vacation_leave']);
Route::post('/insert_vacation_leave',[LeaveController::class,'insert_vacation_leave']);
Route::get('/vacation_status_deactive/{id}',[LeaveController::class,'vacation_status_deactive']);
Route::get('/vacation_status_active/{id}',[LeaveController::class,'vacation_status_active']);
Route::get('/delete_vacation/{id}',[LeaveController::class,'delete_vacation']);
///////vacation leave end



Route::get('deduction', 'AdminController@deduction')->name('deduction');

});


Route::get('admin/payroll',[PayrollController::class,'payroll']);
Route::post('admin/search',[PayrollController::class,'search']);
Route::get('atten_get',[PayrollController::class,'atten_get']);
Route::get('admin/proceed',[PayrollController::class,'payrol_proceed']);

Route::post('update_profile',[AdminController::class,'update_profile']);

Route::view('/profile','Employee/profile');

Route::prefix('employee')->namespace('App\\Http\\Controllers\\Employee')->group(function () {

    Route::get('update_profile', 'AdminController@update_profile')->name('update_profile');
    Route::get('dashboard', 'EmployeeController@dashboard')->name('employee.dashboard');
    Route::post('start-time', 'EmployeeController@starttime')->name('employee.starttime');
    Route::post('end-time', 'EmployeeController@endtime')->name('employee.endtime');
    Route::get('attendance_history', 'EmployeeController@attendance_history')->name('employee.attendance_history');

});
Route::get('employee/sick-leave',[SickLeaveController::class,'sick_leave']);
Route::get('employee/vacation-leave',[SickLeaveController::class,'vacation_leave']);
Route::post('employee/insert_sick_leave',[SickLeaveController::class,'insert_sick_leave']);
Route::post('employee/insert_vacation_leave',[SickLeaveController::class,'insert_vacation_leave']);


Route::get('Testmail','App\Http\Controllers\TestController@Testmail');
