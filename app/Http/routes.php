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

// About route
Route::get('ldap_tester', function(){
   return view('ldap_tester');
});

Route::get('/ldap', ['as' => 'ldap', 'uses' => 'UserController@index']);

// System home routes
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@getIndex']);

// Admin home route
Route::get('/admin', ['as' => 'adminHome', 'uses' => 'HomeController@getAdminHome']);

Route::controller('homeController', 'HomeController');

// Users' home routes
Route::get('aluno', ['as' => 'studentsHome', 'uses' => 'UserController@getStudentsHome']);
Route::get('professor', ['as' => 'professorsHome', 'uses' => 'UserController@getProfessorsHome']);

// Route::get('/professor', ['as' => 'professorsHome', function(){
//    return view('student/studentHome');
// }]);

// About route
Route::get('sobre', function(){
   return view('about');
});

// Contact routes
Route::get('contato', function(){
   return view('contact');
});

// Login route
Route::get('/login', ['as' => 'getLogin', 'uses' => 'AuthController@getLogin']);
Route::post('/login', ['as' => 'postLogin', 'uses' => 'AuthController@postLogin']);
Route::get('logout', ['as' => 'getLogout', 'uses' => 'UserController@logout']);
