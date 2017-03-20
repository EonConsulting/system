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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/builders/page', ['as' => 'builders.page', 'uses' => 'Builders\\PageBuilderController@index']);
    Route::get('/builders/storyline', ['as' => 'builders.storyline', 'uses' => 'Builders\\StorylineBuilderController@index']);
});

Route::group(['middleware' => ['auth'], 'prefix' => '/lecturer'], function() {
    Route::group(['prefix' => '/courses', 'namespace' => 'Courses'], function() {
        Route::get('/', ['as' => 'courses', 'uses' => 'CoursesController@index']);
        Route::get('/create', ['as' => 'courses.create', 'uses' => 'CreateCourseController@index']);
        Route::post('/create', ['as' => 'courses.create', 'uses' => 'CreateCourseController@store']);
        Route::get('/{course}', ['as' => 'courses.single', 'uses' => 'CourseController@show']);
        Route::get('/{course}/storyline', ['as' => 'courses.single.storyline', 'uses' => 'CourseStorylineController@index']);
        Route::post('/{course}/storyline', ['as' => 'courses.single.storyline', 'uses' => 'CourseStorylineController@store']);
    });
    Route::group(['prefix' => '/content', 'namespace' => 'Content'], function() {
        Route::get('/builder', ['as' => 'content.builder', 'uses' => 'ContentBuilderController@index']);
        Route::post('/builder', ['as' => 'content.builder', 'uses' => 'ContentBuilderController@store']);
    });
});

Route::group(['prefix' => '/lti', 'middleware' => ['auth'], 'namespace' => 'LTI'], function() {
    Route::group(['namespace' => 'Dashboards'], function() {
        Route::match(['get', 'post'], '/', ['as' => 'lti.dashboards', 'uses' => 'DashboardLTIController@index']);
    });
    Route::group(['namespace' => 'Users'], function() {
        Route::match(['get', 'post'], '/profile', ['as' => 'lti.users.profile', 'uses' => 'ProfileLTIController@index']);
        Route::match(['get', 'post'], '/profile/update', ['as' => 'lti.users.profile.update', 'uses' => 'ProfileLTIController@update']);
    });
});