<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Departamento;
use App\Models\Professor;
use App\Models\Curso;
use App\Models\Admin;

class HomeController extends Controller
{

   public function getIndex(Request $request){
      if($request->session()->has('username')){
         return redirect()->route('home');
      }
      return view('home');
   }

   public function adminHome(){
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

   public function getUsersHome(Request $request){
      switch (session()->get('role')) {
         case '0':
            return $this->adminHome();
            break;
         case '1':
            return view('student.home');
            break;

         case '2':
            return view('professor.home');
            break;
         default:
            break;
      }
   }

}
