<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Admin;
use App\Student;
use App\Major;
use App\Department;
use App\Professor;

class AdminController extends Controller
{

   // public function getIndex(Request $request){
   //    $students = Student::with('major')->get();
   //    $professors = Professor::with('department')->get();
   //    $majors = Major::all();
   //    $departments = Department::all();
   //    return view('admin/adminHome', compact(
   //       'students',
   //       'professors',
   //       'majors',
   //       'departments'
   //    ));
   // }

   public function getAll(){
      $admin = Admin::all();
      return view ('dashboard.view_admins', ['admins' => $admins]);
   }

}
