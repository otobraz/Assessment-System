<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Adldap\Contracts\AdldapInterface;

class UserController extends Controller
{

   public function logout(Request $request){
      $request->session()->flush();
      return redirect('/')->with('message', 'Você foi desconectado com sucesso!');
   }

   public function getStudentsHome(Request $request){
      //if($request->session()->get('type') == 1){
         return view('student/studentHome');
      //}
      //return redirect('login');
   }

   public function getProfessorsHome(Request $request){
      //if($request->session()->get('type') == 2){
         return view('professor/professorHome');
      //}
      //return redirect('login');
   }
}
