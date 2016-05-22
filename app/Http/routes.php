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

Route::group(['middleware' => ['web']], function () {

   // System home routes
   Route::get('/', ['as' => 'home', 'uses' => 'HomeController@getIndex']);
   Route::get('/index', ['as' => 'home', 'uses' => 'HomeController@getIndex']);

   // Admin home route
   Route::get('/admin', ['as' => 'adminHome', 'uses' => 'HomeController@getAdminHome']);

   // Students home route
   Route::get('/aluno', ['as' => 'studentHome', 'uses' => 'HomeController@getStudentHome']);

   // About route
   Route::get('sobre', function(){
      return view('about');
   });

   // Contact routes
   Route::get('contato', function(){
      return view('contact');
   });

});
