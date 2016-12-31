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

      // dd($myOpenSurveys);

      // foreach ($myOpenSurveys as $openSurvey){
      //
      // }

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
            return view('student.home');
            break;

         case '2':
            return $this->professorsHome();
            break;
         default:
            break;
      }
   }

}
