<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Department;

class DepartmentController extends Controller
{

   public function __construct(){
      $this->middleware('myAuth');
   }

   public function getAll(){
      $majors = Major::all();
      return view ('department.get_all', ['departments' => $department]);
   }

}
