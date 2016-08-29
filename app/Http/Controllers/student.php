<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Student;

class StudentController extends Controller{

   public function getIndex(Request $request){
      return view('student/studentHome');
   }

   public function getAll(){
      $students = Student::all();
      return view ('student.get_all', ['students' => $students]);
   }

}
