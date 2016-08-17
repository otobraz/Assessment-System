<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

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

// Routes that can be accessed iff the user is authenticated
Route::group(['middleware' => ['myAuth']], function () {

   // Admin home route
   Route::get('/admin', ['as' => 'adminHome', 'uses' => 'HomeController@getAdminHome']);

   // Users' home routes
   Route::get('aluno', ['as' => 'studentsHome', 'uses' => 'UserController@getStudentsHome']);
   Route::get('professor', ['as' => 'professorsHome', 'uses' => 'UserController@getProfessorsHome']);

   // Logout route
   Route::get('logout', ['as' => 'getLogout', 'uses' => 'UserController@logout']);

   // Dashboard route
   Route::get('dashboard', function(){
      return view('dashboard');
   });

   Route::get('dashboard1', function(){
      return view('dashboard.starter1');
   });

});

// System home routes
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@getIndex']);

Route::controller('home', 'HomeController');

// About route
Route::get('sobre', function(){
   return view('about');
});

// Contact routes
Route::get('contato', function(){
   return view('contact');
});

Route::get('lista', function(){
   return view('lista_alunos');
});
// Login route
Route::get('/login', ['as' => 'getLogin', 'uses' => 'AuthController@getLogin']);
Route::post('/login', ['as' => 'postLogin', 'uses' => 'AuthController@postLogin']);
