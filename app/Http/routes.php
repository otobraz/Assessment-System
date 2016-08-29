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
   // Route::get('admin', ['as' => 'adminHome', 'uses' => 'AdminController@getIndex']);
   //
   // // Users' home routes
   // Route::get('aluno', ['as' => 'studentsHome', 'uses' => 'StudentController@getIndex']);
   // Route::get('professor', ['as' => 'professorsHome', 'uses' => 'ProfessorController@getIndex']);

   // Home pages
   Route::get('aluno/home', ['as' => 'studentHome', 'uses' => 'HomeController@getUsersHome']);
   Route::get('/professor/home', ['as' => 'professorHome', 'uses' => 'HomeController@getUsersHome']);
   Route::get('/admin/home', ['as' => 'adminHome', 'uses' => 'HomeController@adminHome']);

   // Logout
   Route::get('logout', ['as' => 'studentLogout', 'uses' => 'AuthController@logout']);

   // Route::get('alunos', ['as' => 'viewStudents', 'uses' => 'StudentController@getAll']);
   // Route::get('cursos', ['as' => 'viewMajors', 'uses' => 'MajorController@getAll']);

   // Resources
   Route::resource('curso', 'MajorController', ['names' => [
      'create' => 'curso.criar'
   ]]);

   Route::resource('departamento', 'DepartmentController');
   Route::resource('aluno', 'StudentController');
   Route::resource('professor', 'ProfessorController');
   Route::resource('admin', 'AdminController');

});

// System home
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@getIndex']);

//Route::controller('home', 'HomeController');

// About route
// Route::get('sobre', function(){
//    return view('about');
// });
//
// // Contact routes
// Route::get('contato', function(){
//    return view('contact');
// });
//
// Route::get('lista', function(){
//    return view('lista_alunos');
// });

// Login
Route::get('/login', ['as' => 'getLogin', 'uses' => 'AuthController@getLogin']);
Route::post('/login', ['as' => 'postLogin', 'uses' => 'AuthController@postLogin']);
