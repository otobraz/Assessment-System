<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Major;

class MajorController extends Controller
{

   public function __construct(){
      $this->middleware('myAuth');
   }

   public function getAll(){
      $majors = Major::all();
      return view ('major.get_all', ['majors' => $majors]);
   }

}
