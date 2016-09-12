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
   Route::get('aluno/painel', ['as' => 'studentHome', 'uses' => 'HomeController@getUsersHome']);
   Route::get('professor/painel', ['as' => 'professorHome', 'uses' => 'HomeController@getUsersHome']);
   Route::get('admin/painel', ['as' => 'adminHome', 'uses' => 'HomeController@adminHome']);

   // Logout
   Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);

   // Route::get('alunos', ['as' => 'viewStudents', 'uses' => 'StudentController@getAll']);
   // Route::get('cursos', ['as' => 'viewMajors', 'uses' => 'MajorController@getAll']);

   // Major
   Route::get('cursos', ['as' => 'major.index', 'uses' => 'MajorController@index']);

   Route::get('cursos/criar', ['as' => 'major.create', 'uses' => 'MajorController@create']);
   Route::post('cursos/criar', ['as' => 'major.store', 'uses' => 'MajorController@store']);

   Route::get('cursos/{id}/editar', ['as' => 'major.edit', 'uses' => 'MajorController@edit']);
   Route::put('cursos/{id}', ['as' => 'major.update', 'uses' => 'MajorController@update']);
   Route::delete('cursos/{id}', ['as' => 'major.delete', 'uses' => 'MajorController@destroy']);

   // Route::resource('departamento', 'DepartmentController');
   // Route::resource('aluno', 'StudentController');
   // Route::resource('professor', 'ProfessorController');

   // Administrator
   Route::get('admin', ['as' => 'admin.index', 'uses' => 'AdminController@index']);

   Route::get('admin/criar', ['as' => 'admin.create', 'uses' => 'AdminController@create']);
   Route::post('admin/criar', ['as' => 'admin.store', 'uses' => 'AdminController@store']);

   Route::get('admin/{id}/editar', ['as' => 'admin.edit', 'uses' => 'AdminController@edit']);
   Route::put('admin/{id}', ['as' => 'admin.update', 'uses' => 'AdminController@update']);
   Route::delete('admin/{id}', ['as' => 'admin.delete', 'uses' => 'AdminController@destroy']);

   // Department
   Route::get('departamentos', ['as' => 'department.index', 'uses' => 'DepartmentController@index']);

   Route::get('departamentos/criar', ['as' => 'department.create', 'uses' => 'DepartmentController@create']);
   Route::post('departamentos/criar', ['as' => 'department.store', 'uses' => 'DepartmentController@store']);

   Route::get('departamentos/{id}/editar', ['as' => 'department.edit', 'uses' => 'DepartmentController@edit']);
   Route::put('departamentos/{id}', ['as' => 'department.update', 'uses' => 'DepartmentController@update']);
   Route::delete('departamentos/{id}', ['as' => 'department.delete', 'uses' => 'DepartmentController@destroy']);

   // Student

   // Professor

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
