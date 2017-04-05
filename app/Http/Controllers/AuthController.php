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

   // Gets and returns the LdapUser based on the username (CPF)
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

   // Verifies whether or not the typed password matches the one in the LDAP
   public function isPasswordValid($encodedPassword, $raw){
      $password = base64_encode($this->hexToStr(md5($raw)));
      return $password == $encodedPassword;
   }

   // Converts the hex value to a string
   public function hexToStr($hex) {
      $string = '';
      for ($i = 0; $i < strlen($hex) - 1; $i+=2) {
         $string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
      }
      return $string;
   }

   // Adds the student to the database if the student's registry isn't there yet
   public function insertUpdateStudent($ldapUser, $ldapData){

      $authenticatedUser = array(
         'username' => $ldapUser[0][$ldapData['id_field']][0],
         'first_name' => $ldapUser[0][$ldapData['given_name_field']][0],
         'last_name' => $ldapUser[0][$ldapData['last_name_field']][0],
         'email' => $ldapUser[0][$ldapData['email_field']][0],
         'major_id' => Curso::where('curso', $ldapUser[0][$ldapData['group_field']][0])->first()->value('id'),
         'role' => '1'
      );

      $user = Aluno::where('usuario', $authenticatedUser['username'])->first();

      if(isset($user)){
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

      session()->put($authenticatedUser);

   }

   // Adds the professor to the database if the professor's registry isn't there yet
   public function insertUpdateProfessor($ldapUser, $ldapData){

      $authenticatedUser = array(
         'username' => $ldapUser[0][$ldapData['id_field']][0],
         'first_name' => $ldapUser[0][$ldapData['given_name_field']][0],
         'last_name' => $ldapUser[0][$ldapData['last_name_field']][0],
         'email' => $ldapUser[0][$ldapData['email_field']][0],
         'department_id' => Departamento::where('departamento', $ldapUser[0][$ldapData['group_field']][0])->first()->value('id'),
         'role' => '2'
      );

      $user = Professor::where('usuario', $authenticatedUser['username'])->first();

      if(isset($user)){
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
      session()->put($authenticatedUser);
   }

   /** Show the form for authenticating the user
   *
   * redirects to the home page if the user is already authenticated
   *
   */
   public function getLogin(Request $request){
      if($request->session()->has('username')){
         return redirect('/');
      }
      return view('auth.login');
   }

   /** Authenticates the user
   *
   * redirects to the home page if the user is already authenticatedUser
   *
   */
   public function postLogin(Request $request){
      if($request->session()->has('username')){
         return redirect()->route('home');
      }

      // $authenticatedUser = array(
      //    'id' => "53",
      //    'username' => $request->username,
      //    'first_name' => "Professor",
      //    'last_name' => "Professor",
      //    'email' =>  "professor@email.com",
      //    'department_id' => "2",
      //    'role' => '2'
      // );
      // $request->session()->put($authenticatedUser);
      // return redirect()->route('home');

      $ldapData = config('my_config.ldapData');
      $ldapUserGroups = config('my_config.userGroups');
      if($ldapUser = $this->getLdapUser($ldapData, preg_replace('/\D/', '', $request->input('username')))){
         $userPassword = substr($ldapUser[0][$ldapData['password_field']][0], 5);
         if ($this->isPasswordValid($userPassword, $request->input('password'))){

            if ($major = Curso::where('curso', $ldapUser[0][$ldapData['group_field']][0])->first()){
               $this->insertUpdateStudent($ldapUser, $ldapData);
               return redirect()->route('home');
            }else if($department = Departamento::where('departamento', 'LIKE', $ldapUser[0][$ldapData['group_field']][0])->first()){
               $this->insertUpdateProfessor($authenticatedUser);
               return redirect()->route('home');
            }

            if($professor = Professor::where('usuario', $ldapUser[0][$ldapData['id_field']][0])->first()){
               $authenticatedUser = array(
                  'id' => $professor->id,
                  'username' => $professor->usuario,
                  'first_name' => $professor->nome,
                  'last_name' => $professor->sobrenome,
                  'email' => $professor->email,
                  'role' => '2'
               );
               $request->session()->put($authenticatedUser);
               return redirect()->route('home');

            }else if($admin = Admin::where('usuario', $ldapUser[0][$ldapData['id_field']][0])->first()){
               $authenticatedUser = array(
                  'id' => $admin->id,
                  'username' => $admin->usuario,
                  'first_name' => $admin->nome,
                  'last_name' => $admin->sobrenome,
                  'email' => $admin->email,
               );
               switch ($admin->tipo_id) {
                  case 1:
                  $authenticatedUser = array_add($authenticatedUser, 'role', 0);
                  break;

                  case 2:
                  $authenticatedUser = array_add($authenticatedUser, 'role', 3);
                  break;
               }
               session()->put($authenticatedUser);
               return redirect()->route('home');
            }
            return redirect()->route('login')->with('authError', 'Usuário sem permissão de acesso ao sistema');
         }
      }
      return redirect()->route('login')->with('authError', 'Usuário e/ou Senha inválidos');
   }

   // Logouts the user by flushing the session
   public function logout(Request $request){
      $request->session()->flush();
      return redirect()->route('login')->with('message', 'Você foi desconectado com sucesso!');
   }

}
