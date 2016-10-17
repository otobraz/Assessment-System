<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\Survey;
use App\Models\Professor;
use App\Models\Student;
use App\Models\Question;
use App\Models\QuestionType;

class SurveyController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
      if(session()->get('role') === 'Administrador'){
         $surveys = Survey::orderBy('created_at', 'desc')->get();
         return view ('survey.admin.index', compact('surveys'));
      }else if(session()->get('role') === 'Aluno'){
         $student = Student::find(session()->get('id'));
         foreach ($student->sections as $section) {
            $surveys[] = Survey::find($section->id);
         }
         return view ('survey.student.index', compact('surveys'));
      }
   }

   /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function create()
   {
      $sections = Professor::find(session()->get('id'))->sections;
      $questions = Question::all();
      if(session()->get('role') === 'Administrador'){
         return view('survey.admin.create', compact('sections', 'questions'));
      }else if(session()->get('role') === 'Professor'){
         return view('survey.professor.create', compact('sections'));
      }
   }

   /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(Request $request)
   {
      dd($request->all());
   }

   /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function show($id)
   {
      $survey = Survey::find(decrypt($id));
      $questions = $survey->questions;
      return view('survey.show', compact('survey', 'questions'));
   }

   /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function edit($id)
   {
      //
   }

   /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function update(Request $request, $id)
   {
      //
   }

   /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function destroy($id)
   {
      //
   }

   public function ajaxShowQuestion($id){
      $question = Question::find($id);
      return view('survey.ajax.question', compact('question'))->render();
   }

   public function ajaxSelectQuestion($count){
      $questions = Question::all();
      return view('survey.ajax.select-questions', compact('questions', 'count'))->render();
   }

   public function ajaxCreateQuestion($count){
      $questionTypes = QuestionType::all();
      return view('survey.ajax.create-question', compact('questionTypes', 'count'))->render();
   }

   public function ajaxCreateInput($count, $questionType){
      switch ($questionType) {
         case '1':
            return view('survey.ajax.text-input', compact('count'))->render();
            break;

         case '2':
            return view('survey.ajax.radio-input', compact('count'))->render();
            break;

         case '3':
            return view('survey.ajax.checkbox-input', compact('count'))->render();
            break;
      }
   }

}
