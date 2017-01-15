<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Departamento;
use App\Models\Professor;
use App\Models\Curso;
use App\Models\Turma;
use App\Models\Orientacao;
use App\Models\Admin;
use App\Models\Resposta;

use DB;

class HomeController extends Controller
{

   public function index(Request $request){
      if($request->session()->has('username')){
         return redirect()->route('home');
      }
      return view('home');
   }

   public function adminsHome(){
      $students = Aluno::with('curso')->get();
      $professors = Professor::with('departamento')->get();
      $majors = Curso::all();
      $departments = Departamento::all();
      $admins = Admin::all();
      return view('admin.home', compact(
         'students',
         'professors',
         'admins',
         'majors',
         'departments'
      ));
   }

   public function studentsHome(){
      $student = Aluno::find(session()->get('id'));

      $currentSections = $student->turmas()->OrderByDisciplina()->get()->groupBy('ano')->transform(function($item, $k) {
         return $item->groupBy('semestre');
      })->first()->first();

      $currentGuidances = $student->orientacoes()->emAndamento()->get();

      $myOpenSurveys = collect();

      foreach  ($student->turmas as $section){
         foreach ($section->questionarios as $survey) {

            if($survey->pivot->aberto){
               $response = Resposta::where('questionario_turma_id', $survey->pivot->id)->first();
               if(!isset($response)){
                  $myOpenSurveys = $myOpenSurveys->push(array($survey, $section));
               }
            }
         }
         // $responsesCount[$section->pivot->id] = Resposta::where('questionario_turma_id', $section->pivot->id)->get()->count();
      }

      $array = [1,2];
      return view('student.home', compact(
         'currentSections',
         'currentGuidances',
         'myOpenSurveys',
         'array'
      ));

   }

   public function professorsHome(){
      $professor = Professor::find(session()->get('id'));

      $currentSections = $professor->turmas()->OrderByDisciplina()->get()->groupBy('ano')->transform(function($item, $k) {
         return $item->groupBy('semestre');
      })->first()->first();

      $currentGuidances = $professor->orientacoes()->emAndamento()->get();

      $surveys = $professor->questionarios;

      $myOpenSurveys = collect();

      foreach  ($surveys as $survey){
         foreach  ($survey->turmas()->OrderByDisciplina()->abertos()->get() as $section){
            $myOpenSurveys = $myOpenSurveys->push($section);
            $responsesCount[$section->pivot->id] = Resposta::where('questionario_turma_id', $section->pivot->id)->get()->count();
         }
      }

      return view('professor.home', compact(
         'currentSections',
         'currentGuidances',
         'myOpenSurveys',
         'responsesCount'
      ));

   }

   public function getUsersHome(Request $request){
      switch (session()->get('role')) {
         case '0':
         return $this->adminsHome();
         break;
         case '1':
         return $this->studentsHome();
         break;

         case '2':
         return $this->professorsHome();
         break;
         default:
         break;
      }
   }

}
