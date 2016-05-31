<?php

namespace ShareYourThoughts\Http\Controllers;

use ShareYourThoughts\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function getIndex()
    {
       return view('home');
    }

    public function getAdminHome(){
      return view('admin/adminHome');
   }

   public function getUsersHome(Request $request){
      if($request->session()->get('type') == 1){
         return redirect()->route('studentsHome');
      }else if($request->session()->get('type') == 2){
         return redirect()->route('professorsHome');
      }else if(!$request->session()->get('type')){
         return redirect()->route('login');
      }
   }

   public function getLogin() {
      return view('login');
   }
}
