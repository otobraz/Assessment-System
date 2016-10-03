<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Department;
use App\Models\Professor;
use App\Models\Major;
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
      $students = Student::with('major')->get();
      $professors = Professor::with('department')->get();
      $majors = Major::all();
      $departments = Department::all();
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
      if($request->session()->get('role') === 'Aluno'){
         return view('student.home');
      }else if($request->session()->get('role') === 'Professor'){
         return view('professor.home');
      }else if($request->session()->get('role') === 'Administrador'){
         return $this->adminHome();
      }
   }

}
