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

// Routes that can be accessed iff the user is a student
Route::group(['middleware' => ['auth.student']], function () {

   // Student Routes
   Route::get('aluno/editar', ['as' => 'student.edit', 'uses' => 'StudentController@edit']);
   Route::get('aluno/{id}', ['as' => 'student.show', 'uses' => 'StudentController@show']);

   // Response Routes
   Route::get('resposta/{surveySectionId}/criar', ['as' => 'response.create', 'uses' => 'ResponseController@create']);
   Route::post('resposta/criar', ['as' => 'response.store', 'uses' => 'ResponseController@store']);

});

// Routes that can be accessed iff the user is a professor
Route::group(['middleware' => ['auth.professor']], function () {

   // Professor's route
   Route::get('professor/editar', ['as' => 'professor.edit', 'uses' => 'ProfessorController@edit']);

   // Guidance routes
   Route::get('orientacao/{studentId}/criar', ['as' => 'guidance.create', 'uses' => 'GuidanceController@create']);
   Route::post('orientacao/criar', ['as' => 'guidance.store', 'uses' => 'GuidanceController@store']);
   Route::get('orientacao/{id}/editar', ['as' => 'guidance.edit', 'uses' => 'GuidanceController@edit']);
   Route::put('orientacao/{id}', ['as' => 'guidance.update', 'uses' => 'GuidanceController@update']);
   Route::get('orientacao/{id}/finalizar', ['as' => 'guidance.finish', 'uses' => 'GuidanceController@finish']);
   Route::get('orientacao/{id}/recomecar', ['as' => 'guidance.restart', 'uses' => 'GuidanceController@restart']);
   Route::get('orientacao/{id}/disponibilizar-questionario/', ['as' => 'guidance.provideSurvey', 'uses' => 'GuidanceController@provideSurvey']);
   Route::get('orientacao/{id}/cancelar-questionario/', ['as' => 'guidance.cancelSurvey', 'uses' => 'GuidanceController@cancelSurvey']);

   // Survey routes
   Route::get('questionario/criar', ['as' => 'survey.create', 'uses' => 'SurveyController@create']);
   Route::post('questionario/criar', ['as' => 'survey.store', 'uses' => 'SurveyController@store']);
   Route::get('questionario/{id}/editar', ['as' => 'survey.edit', 'uses' => 'SurveyController@edit']);
   Route::put('questionario/{id}', ['as' => 'survey.update', 'uses' => 'SurveyController@update']);
   Route::get('questionario/{id}/fechar', ['as' => 'survey.close', 'uses' => 'SurveyController@close']);
   Route::get('questionario/{id}/abrir', ['as' => 'survey.open', 'uses' => 'SurveyController@open']);
   Route::get('questionario/{id}/disponibilizar', ['as' => 'survey.provide', 'uses' => 'SurveyController@provide']);
   Route::post('questionario/disponibilizar', ['as' => 'survey.attach', 'uses' => 'SurveyController@attach']);
   Route::get('questionario/turmas/{id}', ['as' => 'survey.showSections', 'uses' => 'SurveyController@showSections']);

   // Ajax
   Route::get('questionario/ajax/escolher-questao/{count}', ['as' => 'ajax.selectQuestion', 'uses' => 'SurveyController@ajaxSelectQuestion']);
   Route::get('questionario/ajax/questao/{id}', ['as' => 'ajax.showQuestion', 'uses' => 'SurveyController@ajaxShowQuestion']);
   Route::get('questionario/ajax/nova-questao/{count}', ['as' => 'ajax.createQuestion', 'uses' => 'SurveyController@ajaxCreateQuestion']);
   Route::get('questionario/ajax/novo-input/{name}/{questionType}', ['as' => 'ajax.createInput', 'uses' => 'SurveyController@ajaxCreateInput']);

});

// Routes that can be accessed iff the user is an admin
Route::group(['middleware' => ['auth.admin']], function () {

   // Route::get('questionario/criar', ['as' => 'survey.create', 'uses' => 'SurveyController@create']);

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

   // Courses
   Route::get('disciplinas', ['as' => 'course.index', 'uses' => 'CourseController@index']);
   Route::get('disciplina/criar', ['as' => 'course.create', 'uses' => 'CourseController@create']);
   Route::post('disciplina/criar', ['as' => 'course.store', 'uses' => 'CourseController@store']);
   Route::get('disciplina/{id}/editar', ['as' => 'course.edit', 'uses' => 'CourseController@edit']);
   Route::put('disciplina/{id}', ['as' => 'course.update', 'uses' => 'CourseController@update']);
   Route::delete('disciplina/{id}', ['as' => 'course.delete', 'uses' => 'CourseController@destroy']);

   // Sections
   Route::get('turma/criar', ['as' => 'section.create', 'uses' => 'SectionController@create']);
   Route::post('turma/criar', ['as' => 'section.store', 'uses' => 'SectionController@store']);
   Route::delete('turma/{id}', ['as' => 'section.delete', 'uses' => 'SectionController@destroy']);
   Route::get('turmas/importar', ['as' => 'section.import', 'uses' => 'SectionController@import']);
   Route::post('turmas/importar', ['as' => 'section.storeFromCsv', 'uses' => 'SectionController@storeFromCsv']);
   Route::get('turmas/importar-ajustes', ['as' => 'section.importRegistrations', 'uses' => 'SectionController@importRegistrations']);
   Route::post('turmas/importar-ajustes', ['as' => 'section.storeRegistrationsFromCsv', 'uses' => 'SectionController@storeRegistrationsFromCsv']);

   // Student
   Route::get('alunos/importar', ['as' => 'student.import', 'uses' => 'StudentController@import']);
   Route::post('alunos/importar', ['as' => 'student.storeFromCsv', 'uses' => 'StudentController@storeFromCsv']);
   Route::delete('aluno/{id}', ['as' => 'student.delete', 'uses' => 'StudentController@destroy']);

   // Professors
   Route::get('professores/importar', ['as' => 'professor.import', 'uses' => 'ProfessorController@import']);
   Route::post('professores/importar', ['as' => 'professor.storeFromCsv', 'uses' => 'ProfessorController@storeFromCsv']);
   Route::delete('professor/{id}', ['as' => 'professor.delete', 'uses' => 'ProfessorController@destroy']);

   // Surveys
   Route::get('questionario/respostas/{id}', ['as' => 'survey.showResponses', 'uses' => 'SurveyController@showResponses']);

   // Questions
   Route::get('perguntas', ['as' => 'question.index', 'uses' => 'QuestionController@index']);
   Route::get('pergunta/criar', ['as' => 'question.create', 'uses' => 'QuestionController@create']);
   Route::post('pergunta/criar', ['as' => 'question.store', 'uses' => 'QuestionController@store']);
   Route::get('pergunta/{id}/editar', ['as' => 'question.edit', 'uses' => 'QuestionController@edit']);
   Route::put('pergunta/{id}', ['as' => 'question.update', 'uses' => 'QuestionController@update']);
   Route::delete('pergunta/{id}', ['as' => 'question.delete', 'uses' => 'QuestionController@destroy']);

   // Choice
   Route::put('opcao/{id}', ['as' => 'choice.update', 'uses' => 'ChoiceController@update']);
   Route::delete('opcao/{id}', ['as' => 'choice.delete', 'uses' => 'ChoiceController@destroy']);

   //Question Types
   Route::get('perguntas/tipos', ['as' => 'questionType.index', 'uses' => 'QuestionTypeController@index']);
   Route::get('perguntas/tipo/criar', ['as' => 'questionType.create', 'uses' => 'QuestionTypeController@create']);
   Route::post('perguntas/tipo/criar', ['as' => 'questionType.store', 'uses' => 'QuestionTypeController@store']);
   Route::get('perguntas/tipo/{id}/editar', ['as' => 'questionType.edit', 'uses' => 'QuestionTypeController@edit']);
   Route::put('perguntas/tipo/{id}', ['as' => 'questionType.update', 'uses' => 'QuestionTypeController@update']);
   Route::delete('perguntas/tipo/{id}', ['as' => 'questionType.delete', 'uses' => 'QuestionTypeController@destroy']);

   //Guidance Types
   Route::get('orientacoes/tipos', ['as' => 'guidanceType.index', 'uses' => 'GuidanceTypeController@index']);
   Route::get('orientacoes/tipo/criar', ['as' => 'guidanceType.create', 'uses' => 'GuidanceTypeController@create']);
   Route::post('orientacoes/tipo/criar', ['as' => 'guidanceType.store', 'uses' => 'GuidanceTypeController@store']);
   Route::get('orientacoes/tipo/{id}/editar', ['as' => 'guidanceType.edit', 'uses' => 'GuidanceTypeController@edit']);
   Route::put('orientacoes/tipo/{id}', ['as' => 'guidanceType.update', 'uses' => 'GuidanceTypeController@update']);
   Route::delete('orientacoes/tipo/{id}', ['as' => 'guidanceType.delete', 'uses' => 'GuidanceTypeController@destroy']);

   //Section Types
   // Route::get('classes/tipos', ['as' => 'sectionType.index', 'uses' => 'SectionTypeController@index']);
   // Route::get('classes/tipo/criar', ['as' => 'sectionType.create', 'uses' => 'SectionTypeController@create']);
   // Route::post('classes/tipo/criar', ['as' => 'sectionType.store', 'uses' => 'SectionTypeController@store']);
   // Route::get('classes/tipo/{id}/editar', ['as' => 'sectionType.edit', 'uses' => 'SectionTypeController@edit']);
   // Route::put('classes/tipo/{id}', ['as' => 'sectionType.update', 'uses' => 'SectionTypeController@update']);
   // Route::delete('classes/tipo/{id}', ['as' => 'sectionType.delete', 'uses' => 'SectionTypeController@destroy']);

   // Question Ajax
   Route::get('pergunta/ajax/novo-input/{questionType}', ['as' => 'ajax.createInput', 'uses' => 'QuestionController@ajaxCreateInput']);
});

// Routes that can be accessed iff the user is authenticated
Route::group(['middleware' => ['auth.user']], function () {

   // Home page
   Route::get('home', ['as' => 'home', 'uses' => 'HomeController@getUsersHome']);

   // Logout
   Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);

   // Sections
   Route::get('turmas', ['as' => 'section.index', 'uses' => 'SectionController@index']);
   Route::get('turma/{id}', ['as' => 'section.show', 'uses' => 'SectionController@show']);

   // Surveys
   Route::get('questionarios', ['as' => 'survey.index', 'uses' => 'SurveyController@index']);
   Route::get('questionario/{id}', ['as' => 'survey.show', 'uses' => 'SurveyController@show']);
   Route::get('questionario/resultados/{surveyId}', ['as' => 'survey.overallResult', 'uses' => 'SurveyController@overallResult']);
   Route::get('questionario/resultado/turma/{surveySectionId}', ['as' => 'survey.classResult', 'uses' => 'SurveyController@classResult']);
   Route::post('questionario/resultados-comparados', ['as' => 'survey.comparedResult', 'uses' => 'SurveyController@comparedResult']);

   // responses
   Route::get('resposta/{id}', ['as' => 'response.show', 'uses' => 'ResponseController@show']);

   // Students
   Route::get('alunos', ['as' => 'student.index', 'uses' => 'StudentController@index']);

   // Professors
   Route::get('professores', ['as' => 'professor.index', 'uses' => 'ProfessorController@index']);
   Route::get('professor/{id}', ['as' => 'professor.show', 'uses' => 'ProfessorController@show']);
   Route::get('professor/{id}/questionarios', ['as' => 'professor.showSurveys', 'uses' => 'ProfessorController@showSurveys']);

   // Guidances
   Route::get('orientacoes', ['as' => 'guidance.index', 'uses' => 'GuidanceController@index']);
   Route::get('orientacao/{id}', ['as' => 'guidance.show', 'uses' => 'GuidanceController@show']);
   Route::get('orientacao/questionario/resposta/{guidanceId}', ['as' => 'guidance.response', 'uses' => 'GuidanceController@showResponse']);
   Route::get('orientacao/resultados/', ['as' => 'guidance.results', 'uses' => 'GuidanceController@getResults']);

});

// System home
Route::get('/', ['as' => '/', 'uses' => 'HomeController@index']);

// Login
Route::get('login', ['as' => 'getLogin', 'uses' => 'AuthController@getLogin']);
Route::post('login', ['as' => 'postLogin', 'uses' => 'AuthController@postLogin']);
