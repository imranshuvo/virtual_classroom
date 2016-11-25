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
Route::get('courses','CourseController@showAll');
Route::post('search','CourseController@search');


//Course
Route::group(['prefix' => 'course'],function(){
	Route::get('{id}','CourseController@showSingle');
	Route::get('{id}/enroll',['middleware' => 'auth', 'uses' => 'CourseController@enroll']);
});

// Teacher
Route::group(['prefix' => 'teacher'], function(){
	Route::get('my-course/{id}',['middleware' => 'auth' , 'uses' => 'TeacherController@singleCourseMaterialPage']);
	Route::get('courses',['middleware' => 'auth' , 'uses' => 'TeacherController@getAllCourses']);
});



//Student
Route::group(['prefix' => 'student'], function(){
	Route::get('courses',['middleware' => 'auth','uses' => 'StudentController@showAllCourses']);
	Route::get('my-course/{id}',['middleware' => 'auth', 'uses' => 'StudentController@singleCourseMaterialPage']);
	Route::get('profile',['middleware' => 'auth', 'uses' => 'StudentController@getPrivateProfile']);
});



//Library

Route::group(['prefix' => 'vc/library'], function(){
	Route::get('/','LibraryController@getBooks');
	Route::get('new',['middleware' => 'auth', 'uses' => 'LibraryController@addBookView']);
	Route::post('save',['middleware' => 'auth','uses' => 'LibraryController@saveBook']);
});



//Messaging/chat

Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});
