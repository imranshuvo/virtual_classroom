<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login','WelcomeController@login');
Route::get('/signup','WelcomeController@signup');
Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/register/course',['middleware' => 'auth', 'uses' => 'CourseController@getCreateCourseView']);
Route::post('/register/course',['middleware' => 'auth' , 'uses' => 'CourseController@create']);

Route::get('/teacher/courses',['middleware' => 'auth' , 'uses' => 'TeacherController@getAllCourses']);
