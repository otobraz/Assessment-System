<?php

namespace ShareYourThoughts\Http\Controllers;

use ShareYourThoughts\Http\Requests;
use Illuminate\Http\Request;
use View;

class HomeController extends Controller
{

    public function getIndex()
    {
       return View::make('home');
    }

    public function getAdminHome(){
      return View::make('admin/adminHome');
   }

   public function getStudentHome(){
      return View::make('student/studentHome');
   }

   public function getLogin() {
      return View::make('login');
   }
}
