<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Hash;

use App\Models\Major;
use App\Models\Department;
use App\Models\Student;
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
      $user = Student::where('username', $authenticatedUser['username'])->first();
      if(isset($user)){
         session()->put('id', $user->id);
         $user->fill($authenticatedUser);
         $user->save();
      }else{
         $newUser = new Student();
         $newUser->username = $authenticatedUser['username'];
         $newUser->first_name = $authenticatedUser['first_name'];
         $newUser->last_name = $authenticatedUser['last_name'];
         $newUser->email = $authenticatedUser['email'];
         $newUser->major_id = $authenticatedUser['major_id'];
         $newUser->save();
         session()->put('id', $newUser->id);
      }

      // $user->username = $authenticatedUser['username'];
      // $user->first_name = $authenticatedUser['first_name'];
      // $user->last_name = $authenticatedUser['last_name'];
      // $user->email = $authenticatedUser['email'];
      // $user->major_id = $authenticatedUser['major_id'];
   }

   public function insertUpdateProfessor($authenticatedUser){
      $user = Professor::where('username', $authenticatedUser['username'])->first();
      if(isset($user)){
         session()->put('id', $user->id);
         $user->fill($authenticatedUser);
         $user->save();
      }else{
         $newUser = new Professor();
         $newUser->username = $authenticatedUser['username'];
         $newUser->first_name = $authenticatedUser['first_name'];
         $newUser->last_name = $authenticatedUser['last_name'];
         $newUser->email = $authenticatedUser['email'];
         $newUser->department_id = $authenticatedUser['department_id'];
         $newUser->save();
         session()->put('id', $newUser->id);
      }
      // $professorsTable = DB::table('professors');
      // if($user = $professorsTable->where('username', $authenticatedUser['username'])
      // ->select('username', 'first_name', 'last_name', 'email', 'department_id')->get()){
      //    if((array)$user[0] == $authenticatedUser){
      //       $professorsTable->update($authenticatedUser);
      //    }
      // }else{
      //    $professorsTable->insertGetId($authenticatedUser);
      // }
   }

   public function getLogin(Request $request){
      if($request->session()->has('username')){
         return redirect('/');
      }
      return view('auth.login');
   }

   public function postLogin(Request $request){
      if($request->session()->has('username')){
         // Redirect to user's home page
         return redirect()->route('home');
      }else {
         $ldapData = config('my_config.ldapData');
         // $ldapUserGroups = config('my_config.userGroups');
         if($ldapUser = $this->getLdapUser($ldapData, $request->input('username'))){
            $ou = $ldapUser[0][$ldapData['group_field']][0];

            // If the user's 'ou' field is in the majors table, he is a student
            if($major = Major::where('major', $ldapUser[0][$ldapData['group_field']][0])->first()){
               $userPassword = substr($ldapUser[0][$ldapData['password_field']][0], 5);
               if ($this->isPasswordValid($userPassword, $request->input('password'))){
                  $authenticatedUser = array(
                     'username' => $ldapUser[0][$ldapData['id_field']][0],
                     'first_name' => $ldapUser[0][$ldapData['given_name_field']][0],
                     'last_name' => $ldapUser[0][$ldapData['last_name_field']][0],
                     'email' => $ldapUser[0][$ldapData['email_field']][0],
                     'major_id' => $major->id,
                     'role' => 'Aluno'
                  );
                  $this->insertUpdateStudent($authenticatedUser);
                  $request->session()->put($authenticatedUser);
                  return redirect()->route('home');
               }

            // If the user's 'ou' field is in the departments table, he is a professor
            }else if($department = Department::where('department', 'LIKE', "%$ou%")->first()){
               $userPassword = substr($ldapUser[0][$ldapData['password_field']][0], 5);
               if ($this->isPasswordValid($userPassword, $request->input('password'))){
                  $authenticatedUser = array(
                     'username' => $ldapUser[0][$ldapData['id_field']][0],
                     'first_name' => $ldapUser[0][$ldapData['given_name_field']][0],
                     'last_name' => $ldapUser[0][$ldapData['last_name_field']][0],
                     'email' => $ldapUser[0][$ldapData['email_field']][0],
                     'department_id' => $department->id,
                     'role' => 'Professor'
                  );
                  $this->insertUpdateProfessor($authenticatedUser);
                  $request->session()->put($authenticatedUser); // put role in session
                  return redirect()->route('home');
               }
            }
         }
         $user = Admin::where('username', $request->username)->first();
         //dd(bcrypt($request->password));
         //dd(Hash::check($request->input('password'), $user->password));
         if(isset($user) && Hash::check($request->input('password'), $user->password)){
            $request->session()->put(array(
               'id' => $user->id,
               'username' => $user->username,
               'first_name' => $user->first_name,
               'last_name' => $user->last_name,
               'email' => $user->email,
               'role' => 'Administrador'
            ));
            return redirect()->route('home');
         }
         return redirect('login')->with('authError', 'Usuário e/ou Senha inválidos');
      }
   }

   public function logout(Request $request){
      $request->session()->flush();
      return redirect('login')->with('message', 'Você foi desconectado com sucesso!');
   }

}
