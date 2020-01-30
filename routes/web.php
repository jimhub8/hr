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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Auth::routes(['verify' => true]);


// Route::get('/home', 'HomeController@index')->name('home');




Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@hr')->name('hr');
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');

    Route::resource('leaves', 'LeaveController');
    Route::resource('leave_type', 'LeaveTypeController');
    Route::resource('expense', 'ExpenseController');
    Route::resource('attendance', 'AttendaceController');
    Route::resource('task', 'TaskController');
    Route::resource('departments', 'DepartmentController');
    Route::resource('promotions', 'PromotionController');
    Route::resource('complains', 'ComplainController');
    Route::resource('warnings', 'WarningController');
    Route::resource('announcements', 'AnnouncementController');



    Route::post('/distance', 'HomeController@distance')->name('distance');

    Route::get('searchUsers/{search}', 'UserController@searchUsers')->name('searchUsers');
    Route::get('deletedUsers', 'UserController@deletedUsers')->name('deletedUsers');
});
