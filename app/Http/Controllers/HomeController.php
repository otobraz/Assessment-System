<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Student;
use App\Department;
use App\Professor;
use App\Major;
use App\Admin;

class HomeController extends Controller
{

   public function getIndex(Request $request){
      if($request->session()->has('username')){
         return $this->getUsersHome($request);
      }
      return view('home');
   }

   public function adminHome(){
      $students = Student::with('major')->get();
      $professors = Professor::with('department')->get();
      $majors = Major::all();
      $departments = Department::all();
      $admins = Admin::all();
      return view('admin/adminHome', compact(
         'students',
         'professors',
         'admins',
         'majors',
         'departments'
      ));
   }

   public function getUsersHome(Request $request){
      if($request->session()->get('role') == 1){
         return view('student/studentHome');
      }else if($request->session()->get('role') == 2){
         return view('professor/professorHome');
      }else if(!$request->session()->get('role')){
         return $this->adminHome();
      }
   }

}
