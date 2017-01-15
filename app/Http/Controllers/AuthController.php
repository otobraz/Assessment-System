<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Hash;

use App\Models\Curso;
use App\Models\Departamento;
use App\Models\Aluno;
use App\Models\Professor;
use App\Models\Admin;

class AuthController extends Controller{

   public function getLdapUser($ldapData = null, $username = null){
      $ds = ldap_connect($ldapData['server']); // your ldap server
      try{
         $bind = ldap_bind($ds, $ldapData['cn'] . "," . $ldapData['domain'], base64_decode($ldapData['password']));
         $filter = "(" . $ldapData['id_field'] . "=" . $username . ")"; // this command requires some filter
         $justThese = array(
            $ldapData['id_field'],
            $ldapData['given_name_field'],
            $ldapData['last_name_field'],
            $ldapData['email_field'],
            $ldapData['group_field'],
            $ldapData['password_field']
         ); // the attributes to pull, which is much more efficient than pulling all attributes if you don't do this
         $sr = ldap_search($ds, $ldapData['domain'], $filter, $justThese);
         $entry = ldap_get_entries($ds, $sr);
         if ($entry['count'] > 0) {
            return $entry;
         }
         return null;
      }catch(\Exception $e){
         abort(503);
      }
   }

   public function isPasswordValid($encodedPassword, $raw){
      $password = base64_encode($this->hexToStr(md5($raw)));
      return $password == $encodedPassword;
   }

   public function hexToStr($hex) {
      $string = '';
      for ($i = 0; $i < strlen($hex) - 1; $i+=2) {
         $string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
      }
      return $string;
   }

   public function insertUpdateStudent($authenticatedUser){
      $user = Aluno::where('usuario', $authenticatedUser['username'])->first();
      if(isset($user)){
         $user->usuario = $authenticatedUser['username'];
         $user->nome = $authenticatedUser['first_name'];
         $user->sobrenome = $authenticatedUser['last_name'];
         $user->email = $authenticatedUser['email'];
         $user->curso_id = $authenticatedUser['major_id'];
         $user->save();
         session()->put('id', $user->id);
      }else{
         $newUser = new Aluno();
         $newUser->usuario = $authenticatedUser['username'];
         $newUser->matricula = $authenticatedUser['username'];
         $newUser->nome = $authenticatedUser['first_name'];
         $newUser->sobrenome = $authenticatedUser['last_name'];
         $newUser->email = $authenticatedUser['email'];
         $newUser->curso_id = $authenticatedUser['major_id'];
         $newUser->save();
         session()->put('id', $newUser->id);
      }
   }

   public function insertUpdateProfessor($authenticatedUser){
      $user = Professor::where('usuario', $authenticatedUser['username'])->first();
      if(isset($user)){
         $user->usuario = $authenticatedUser['username'];
         $user->nome = $authenticatedUser['first_name'];
         $user->sobrenome = $authenticatedUser['last_name'];
         $user->save();
         session()->put('id', $user->id);
      }else{
         $newUser = new Professor();
         $newUser->usuario = $authenticatedUser['username'];
         $newUser->nome = $authenticatedUser['first_name'];
         $newUser->sobrenome = $authenticatedUser['last_name'];
         $newUser->email = $authenticatedUser['email'];
         $newUser->departamento_id = $authenticatedUser['department_id'];
         $newUser->save();
         session()->put('id', $newUser->id);
      }
   }

   public function getLogin(Request $request){
      if($request->session()->has('username')){
         return redirect('/');
      }
      return view('auth.login');
   }

   public function postAdminLogin(Admin $user, Request $request){

      if(Hash::check($request->input('password'), $user->senha)){
         $request->session()->put(array(
            'id' => $user->id,
            'username' => $user->usuario,
            'first_name' => $user->nome,
            'last_name' => $user->sobrenome,
            'email' => $user->email,
            'role' => '0'
         ));
         return redirect()->route('home');
      }
      return redirect('login')->with('authError', 'Usuário e/ou Senha inválidos');
   }

   public function postLogin(Request $request){
      if($request->session()->has('username')){
         return redirect()->route('home');
      }

      // $authenticatedUser = array(
      //    'id' => "30",
      //    'username' => $request->username,
      //    'first_name' => "Professor",
      //    'last_name' => "Professor",
      //    'email' =>  "theo@decsi.ufop.br",
      //    'department_id' => "2",
      //    'role' => '2'
      // );
      // $request->session()->put($authenticatedUser);
      // return redirect()->route('home');

      $user = Admin::where('usuario', $request->username)->first();
      if (isset($user)){
         return $this->postAdminLogin($user, $request);
      }else{
         $ldapData = config('my_config.ldapData');
         // $ldapUserGroups = config('my_config.userGroups');
         if($ldapUser = $this->getLdapUser($ldapData, $request->input('username'))){
            $ou = $ldapUser[0][$ldapData['group_field']][0];
            // $ou = "INSTITUTO DE CIENCIAS EXATAS E APLICADAS";
            // If the user's 'ou' field is in the majors table, he is a student
            if($major = Curso::where('curso', $ou)->first()){
               $userPassword = substr($ldapUser[0][$ldapData['password_field']][0], 5);
               if ($this->isPasswordValid($userPassword, $request->input('password'))){
                  $authenticatedUser = array(
                     'username' => $ldapUser[0][$ldapData['id_field']][0],
                     'first_name' => $ldapUser[0][$ldapData['given_name_field']][0],
                     'last_name' => $ldapUser[0][$ldapData['last_name_field']][0],
                     'email' => $ldapUser[0][$ldapData['email_field']][0],
                     'major_id' => $major->id,
                     'role' => '1'
                  );
                  $this->insertUpdateStudent($authenticatedUser);
                  $request->session()->put($authenticatedUser);
                  return redirect()->route('home');
               }
               return redirect('login')->with('authError', 'Usuário e/ou Senha inválidos');

               // If the user's 'ou' field is in the departments table, he is a professor
            }else if($department = Departamento::where('departamento', 'LIKE', "%$ou%")->first()){
               $userPassword = substr($ldapUser[0][$ldapData['password_field']][0], 5);
               if ($this->isPasswordValid($userPassword, $request->input('password'))){
                  $authenticatedUser = array(
                     'username' => $ldapUser[0][$ldapData['id_field']][0],
                     'first_name' => $ldapUser[0][$ldapData['given_name_field']][0],
                     'last_name' => $ldapUser[0][$ldapData['last_name_field']][0],
                     'email' => $ldapUser[0][$ldapData['email_field']][0],
                     'department_id' => $department->id,
                     'role' => '2'
                  );
                  $this->insertUpdateProfessor($authenticatedUser);
                  $request->session()->put($authenticatedUser); // put role in session
                  return redirect()->route('home');
               }
               return redirect('login')->with('authError', 'Usuário e/ou Senha inválidos');
            }else if($ou == "INSTITUTO DE CIENCIAS EXATAS E APLICADAS"){
               $professor = Professor::where('usuario', $ldapUser[0][$ldapData['id_field']][0]);
               if(isset($professor)){
                  $userPassword = substr($ldapUser[0][$ldapData['password_field']][0], 5);
                  if ($this->isPasswordValid($userPassword, $request->input('password'))){
                     $authenticatedUser = array(
                        'username' => $ldapUser[0][$ldapData['id_field']][0],
                        'first_name' => $ldapUser[0][$ldapData['given_name_field']][0],
                        'last_name' => $ldapUser[0][$ldapData['last_name_field']][0],
                        'email' => $professor->email,
                        'department_id' => $professor->department->id,
                        'role' => '2'
                     );
                     $this->insertUpdateProfessor($authenticatedUser);
                     $request->session()->put($authenticatedUser); // put role in session
                     return redirect()->route('home');
                  }
               }
            }
            return redirect('login')->with('authError', 'Usuário sem permissão de acesso ao sistema');
         }
         return redirect('login')->with('authError', 'CPF inválido');
      }
   }

   public function logout(Request $request){
      $request->session()->flush();
      return redirect('login')->with('message', 'Você foi desconectado com sucesso!');
   }

}
