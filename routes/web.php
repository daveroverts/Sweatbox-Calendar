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

Route::get('/', 'HomeController@index');

Auth::routes();

//Calendar
Route::resource('/calendar', 'CalendarController');
Route::get('/calendar/startSession/{session}','CalendarController@startSession')->name('calendar.start');
Route::get('/calendar/stopSession/{session}','CalendarController@stopSession')->name('calendar.stop');

//Student
Route::get('/student/restore', 'StudentController@showRestoreForm')->name('student.restore');
Route::post('/student/restore', 'StudentController@restore')->name('student.restore');
Route::resource('/student', 'StudentController');

//Change password
Route::get('/changePassword', 'HomeController@showChangePasswordForm');
Route::post('/changePassword', 'HomeController@changePassword')->name('changePassword');

//Mentor
Route::resource('/mentor', 'MentorController');