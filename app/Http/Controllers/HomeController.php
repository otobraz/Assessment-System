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
      if($request->session()->get('group') == "SISTEMAS DE INFORMACAO"){
         $request->session()->put('type', 1);
         return redirect()->route('studentsHome');
      }else{
         $request->session()->put('type', 2);
         return redirect()->route('professorsHome');
      }
   }

   public function getLogin() {
      return view('login');
   }
}
