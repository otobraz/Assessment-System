<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProfessorController extends Controller{

   public function getIndex(Request $request){
      return view('professor/professorHome');
   }

}
