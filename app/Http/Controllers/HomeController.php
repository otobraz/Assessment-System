<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use View;

class HomeController extends Controller
{
   public function getIndex() {
      return View::make('login');
   }

   public function getAdminHome(){
      return View::make('admin/adminHome');
   }

   public function getStudentHome(){
      return View::make('student/studentHome');
   }
}
