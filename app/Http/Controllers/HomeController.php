<?php

namespace ShareYourThoughts\Http\Controllers;

use ShareYourThoughts\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{

   public function getIndex(Request $request){
      if($request->session()->has('username')){
         return $this->getUsersHome($request);
      }
      return view('home');
   }

   public function getAdminHome(){
      return view('admin/adminHome');
   }

   public function getUsersHome(Request $request){
      if($request->session()->get('role_id') == 2){
         return redirect()->route('studentsHome');
      }else if($request->session()->get('role_id') == 3){
         return redirect()->route('professorsHome');
      }else if(!$request->session()->get('role_id')){
         return redirect()->route('login');
      }
   }

   public function getLogin() {
      return view('login');
   }
}
