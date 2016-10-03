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
Route::group(['middleware' => ['auth.user']], function () {

   // User's home page
   Route::get('home', ['as' => 'home', 'uses' => 'HomeController@getUsersHome']);

   // Logout
   Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);

   // Survey Routes
   Route::get('questionarios', ['as' => 'survey.index', 'uses' => 'SurveyController@index']);
   Route::get('questionario/criar', ['as' => 'survey.create', 'uses' => 'SurveyController@create']);
   Route::post('questionario/criar', ['as' => 'survey.store', 'uses' => 'SurveyController@store']);


   Route::get('resposta/{id}/criar', ['as' => 'response.create', 'uses' => 'ResponseController@create']);
   Route::post('resposta/criar', ['as' => 'response.store', 'uses' => 'ResponseController@store']);

});

// Routes that can be accessed iff the user is a student
Route::group(['middleware' => ['auth.student']], function () {

   // Student Routes
   Route::get('aluno/editar', ['as' => 'student.edit', 'uses' => 'StudentController@edit']);
   Route::get('aluno/{id}', ['as' => 'student.show', 'uses' => 'StudentController@show']);

   // Response Routes
   // Route::get('resposta/{id}/criar', ['as' => 'response.create', 'uses' => 'ResponseController@create']);
   // Route::post('resposta/criar', ['as' => 'response.store', 'uses' => 'ResponseController@store']);

});

// Routes that can be accessed iff the user is a professor
Route::group(['middleware' => ['auth.professor']], function () {

   // Survey Routes
   // Route::get('questionario/criar', ['as' => 'survey.create', 'uses' => 'SurveyController@create']);
   // Route::post('questionario/criar', ['as' => 'survey.store', 'uses' => 'SurveyController@store']);

});

// Routes that can be accessed iff the user is an admin
Route::group(['middleware' => ['auth.admin']], function () {

   // Major
   Route::get('cursos', ['as' => 'major.index', 'uses' => 'MajorController@index']);
   Route::get('curso/criar', ['as' => 'major.create', 'uses' => 'MajorController@create']);
   Route::post('curso/criar', ['as' => 'major.store', 'uses' => 'MajorController@store']);
   Route::get('curso/{id}/editar', ['as' => 'major.edit', 'uses' => 'MajorController@edit']);
   Route::put('curso/{id}', ['as' => 'major.update', 'uses' => 'MajorController@update']);
   Route::delete('curso/{id}', ['as' => 'major.delete', 'uses' => 'MajorController@destroy']);

   // Administrator
   Route::get('admins', ['as' => 'admin.index', 'uses' => 'AdminController@index']);
   Route::get('admin/criar', ['as' => 'admin.create', 'uses' => 'AdminController@create']);
   Route::post('admin/criar', ['as' => 'admin.store', 'uses' => 'AdminController@store']);
   Route::get('admin/{id}/editar', ['as' => 'admin.edit', 'uses' => 'AdminController@edit']);
   Route::get('admin/{id}/editar/senha', ['as' => 'admin.editPassword', 'uses' => 'AdminController@editPassword']);
   Route::put('admin/{id}', ['as' => 'admin.update', 'uses' => 'AdminController@update']);
   Route::put('admin/{id}/senha', ['as' => 'admin.updatePassword', 'uses' => 'AdminController@updatePassword']);
   Route::delete('admin/{id}', ['as' => 'admin.delete', 'uses' => 'AdminController@destroy']);

   // Department
   Route::get('departamentos', ['as' => 'department.index', 'uses' => 'DepartmentController@index']);
   Route::get('departamento/criar', ['as' => 'department.create', 'uses' => 'DepartmentController@create']);
   Route::post('departamento/criar', ['as' => 'department.store', 'uses' => 'DepartmentController@store']);
   Route::get('departamento/{id}/editar', ['as' => 'department.edit', 'uses' => 'DepartmentController@edit']);
   Route::put('departamento/{id}', ['as' => 'department.update', 'uses' => 'DepartmentController@update']);
   Route::delete('departamento/{id}', ['as' => 'department.delete', 'uses' => 'DepartmentController@destroy']);

   // Sections
   Route::get('turmas', ['as' => 'section.index', 'uses' => 'SectionController@index']);
   Route::get('turma/criar', ['as' => 'section.create', 'uses' => 'SectionController@create']);
   Route::post('turma/criar', ['as' => 'section.store', 'uses' => 'SectionController@store']);
   // Route::get('turma/{id}/editar', ['as' => 'section.edit', 'uses' => 'SectionController@edit']);
   // Route::put('turma/{id}', ['as' => 'section.update', 'uses' => 'SectionController@update']);
   Route::delete('turma/{id}', ['as' => 'section.delete', 'uses' => 'SectionController@destroy']);

   // Student
   Route::get('alunos', ['as' => 'student.index', 'uses' => 'StudentController@index']);
   Route::delete('aluno/{id}', ['as' => 'student.delete', 'uses' => 'StudentController@destroy']);

   // Professor
   Route::get('professores', ['as' => 'professor.index', 'uses' => 'ProfessorController@index']);
   Route::delete('professor/{id}', ['as' => 'professor.delete', 'uses' => 'ProfessorController@destroy']);

   //Question Types
   Route::get('perguntas/tipos', ['as' => 'questionType.index', 'uses' => 'QuestionTypeController@index']);
   Route::get('perguntas/tipo/criar', ['as' => 'questionType.create', 'uses' => 'QuestionTypeController@create']);
   Route::post('perguntas/tipo/criar', ['as' => 'questionType.store', 'uses' => 'QuestionTypeController@store']);
   Route::get('perguntas/tipo/{id}/editar', ['as' => 'questionType.edit', 'uses' => 'QuestionTypeController@edit']);
   Route::put('perguntas/tipo/{id}', ['as' => 'questionType.update', 'uses' => 'QuestionTypeController@update']);
   Route::delete('perguntas/tipo/{id}', ['as' => 'questionType.delete', 'uses' => 'QuestionTypeController@destroy']);

   //Section Types
   Route::get('classes/tipos', ['as' => 'sectionType.index', 'uses' => 'SectionTypeController@index']);
   Route::get('classes/tipo/criar', ['as' => 'sectionType.create', 'uses' => 'SectionTypeController@create']);
   Route::post('classes/tipo/criar', ['as' => 'sectionType.store', 'uses' => 'SectionTypeController@store']);
   Route::get('classes/tipo/{id}/editar', ['as' => 'sectionType.edit', 'uses' => 'SectionTypeController@edit']);
   Route::put('classes/tipo/{id}', ['as' => 'sectionType.update', 'uses' => 'SectionTypeController@update']);
   Route::delete('classes/tipo/{id}', ['as' => 'sectionType.delete', 'uses' => 'SectionTypeController@destroy']);

});

// System home
Route::get('/', ['as' => '/', 'uses' => 'HomeController@getIndex']);

// Login
Route::get('login', ['as' => 'getLogin', 'uses' => 'AuthController@getLogin']);
Route::post('login', ['as' => 'postLogin', 'uses' => 'AuthController@postLogin']);
