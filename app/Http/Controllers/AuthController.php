<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Hash;

use App\Major;
use App\Department;
use App\Student;
use App\Admin;

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
      $user->fill($authenticatedUser);
      $user->save();
      // $user->username = $authenticatedUser['username'];
      // $user->first_name = $authenticatedUser['first_name'];
      // $user->last_name = $authenticatedUser['last_name'];
      // $user->email = $authenticatedUser['email'];
      // $user->major_id = $authenticatedUser['major_id'];
   }

   public function insertUpdateProfessor($authenticatedUser){
      $user = Professor::where('username', $authenticatedUser['username'])->first();
      $user->fill($authenticatedUser);
      $user->save();
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
         $ldapUserGroups = config('my_config.userGroups');
         if($ldapUser = $this->getLdapUser($ldapData, $request->input('username'))){
            $ouValue = $this->removeAccents($ldapUser[0][$ldapData['group_field']][0]);

            // If the user's 'ou' field is in the majors table, he is a student
            if($major = Major::where('major', $ouValue)->first()){
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
                  return redirect()->route('studentHome');
               }

               // If the user's 'ou' field is in the departments table, he is a professor
            }else if($department = Department::where('department', $ouValue)->first()){
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
                  return redirect()->route('professorHome');
               }
            }
         }
         $user = Admin::where('username', $request->username)->first();
         //dd(bcrypt($request->password));
         //dd(Hash::check($request->input('password'), $user->password));
         if(isset($user) && Hash::check($request->input('password'), $user->password)){
            $request->session()->put(array(
               'username' => $user->username,
               'first_name' => $user->first_name,
               'last_name' => $user->last_name,
               'email' => $user->email,
               'role' => 'Administrador'
            ));
            return redirect()->route('adminHome');
         }
         return redirect('login')->with('authError', 'Usuário e/ou Senha inválidos');
      }
   }

   public function logout(Request $request){
      $request->session()->flush();
      return redirect('/')->with('message', 'Você foi desconectado com sucesso!');
   }

   public function removeAccents($str){
      static $map = [
         // single letters
         'à' => 'a',
         'á' => 'a',
         'â' => 'a',
         'ã' => 'a',
         'ä' => 'a',
         'ą' => 'a',
         'å' => 'a',
         'ā' => 'a',
         'ă' => 'a',
         'ǎ' => 'a',
         'ǻ' => 'a',
         'À' => 'A',
         'Á' => 'A',
         'Â' => 'A',
         'Ã' => 'A',
         'Ä' => 'A',
         'Ą' => 'A',
         'Å' => 'A',
         'Ā' => 'A',
         'Ă' => 'A',
         'Ǎ' => 'A',
         'Ǻ' => 'A',
         'ç' => 'c',
         'ć' => 'c',
         'ĉ' => 'c',
         'ċ' => 'c',
         'č' => 'c',
         'Ç' => 'C',
         'Ć' => 'C',
         'Ĉ' => 'C',
         'Ċ' => 'C',
         'Č' => 'C',
         'ď' => 'd',
         'đ' => 'd',
         'Ð' => 'D',
         'Ď' => 'D',
         'Đ' => 'D',
         'è' => 'e',
         'é' => 'e',
         'ê' => 'e',
         'ë' => 'e',
         'ę' => 'e',
         'ē' => 'e',
         'ĕ' => 'e',
         'ė' => 'e',
         'ě' => 'e',
         'È' => 'E',
         'É' => 'E',
         'Ê' => 'E',
         'Ë' => 'E',
         'Ę' => 'E',
         'Ē' => 'E',
         'Ĕ' => 'E',
         'Ė' => 'E',
         'Ě' => 'E',
         'ƒ' => 'f',
         'ĝ' => 'g',
         'ğ' => 'g',
         'ġ' => 'g',
         'ģ' => 'g',
         'Ĝ' => 'G',
         'Ğ' => 'G',
         'Ġ' => 'G',
         'Ģ' => 'G',
         'ĥ' => 'h',
         'ħ' => 'h',
         'Ĥ' => 'H',
         'Ħ' => 'H',
         'ì' => 'i',
         'í' => 'i',
         'î' => 'i',
         'ï' => 'i',
         'ĩ' => 'i',
         'ī' => 'i',
         'ĭ' => 'i',
         'į' => 'i',
         'ſ' => 'i',
         'ǐ' => 'i',
         'Ì' => 'I',
         'Í' => 'I',
         'Î' => 'I',
         'Ï' => 'I',
         'Ĩ' => 'I',
         'Ī' => 'I',
         'Ĭ' => 'I',
         'Į' => 'I',
         'İ' => 'I',
         'Ǐ' => 'I',
         'ĵ' => 'j',
         'Ĵ' => 'J',
         'ķ' => 'k',
         'Ķ' => 'K',
         'ł' => 'l',
         'ĺ' => 'l',
         'ļ' => 'l',
         'ľ' => 'l',
         'ŀ' => 'l',
         'Ł' => 'L',
         'Ĺ' => 'L',
         'Ļ' => 'L',
         'Ľ' => 'L',
         'Ŀ' => 'L',
         'ñ' => 'n',
         'ń' => 'n',
         'ņ' => 'n',
         'ň' => 'n',
         'ŉ' => 'n',
         'Ñ' => 'N',
         'Ń' => 'N',
         'Ņ' => 'N',
         'Ň' => 'N',
         'ò' => 'o',
         'ó' => 'o',
         'ô' => 'o',
         'õ' => 'o',
         'ö' => 'o',
         'ð' => 'o',
         'ø' => 'o',
         'ō' => 'o',
         'ŏ' => 'o',
         'ő' => 'o',
         'ơ' => 'o',
         'ǒ' => 'o',
         'ǿ' => 'o',
         'Ò' => 'O',
         'Ó' => 'O',
         'Ô' => 'O',
         'Õ' => 'O',
         'Ö' => 'O',
         'Ø' => 'O',
         'Ō' => 'O',
         'Ŏ' => 'O',
         'Ő' => 'O',
         'Ơ' => 'O',
         'Ǒ' => 'O',
         'Ǿ' => 'O',
         'ŕ' => 'r',
         'ŗ' => 'r',
         'ř' => 'r',
         'Ŕ' => 'R',
         'Ŗ' => 'R',
         'Ř' => 'R',
         'ś' => 's',
         'š' => 's',
         'ŝ' => 's',
         'ş' => 's',
         'Ś' => 'S',
         'Š' => 'S',
         'Ŝ' => 'S',
         'Ş' => 'S',
         'ţ' => 't',
         'ť' => 't',
         'ŧ' => 't',
         'Ţ' => 'T',
         'Ť' => 'T',
         'Ŧ' => 'T',
         'ù' => 'u',
         'ú' => 'u',
         'û' => 'u',
         'ü' => 'u',
         'ũ' => 'u',
         'ū' => 'u',
         'ŭ' => 'u',
         'ů' => 'u',
         'ű' => 'u',
         'ų' => 'u',
         'ư' => 'u',
         'ǔ' => 'u',
         'ǖ' => 'u',
         'ǘ' => 'u',
         'ǚ' => 'u',
         'ǜ' => 'u',
         'Ù' => 'U',
         'Ú' => 'U',
         'Û' => 'U',
         'Ü' => 'U',
         'Ũ' => 'U',
         'Ū' => 'U',
         'Ŭ' => 'U',
         'Ů' => 'U',
         'Ű' => 'U',
         'Ų' => 'U',
         'Ư' => 'U',
         'Ǔ' => 'U',
         'Ǖ' => 'U',
         'Ǘ' => 'U',
         'Ǚ' => 'U',
         'Ǜ' => 'U',
         'ŵ' => 'w',
         'Ŵ' => 'W',
         'ý' => 'y',
         'ÿ' => 'y',
         'ŷ' => 'y',
         'Ý' => 'Y',
         'Ÿ' => 'Y',
         'Ŷ' => 'Y',
         'ż' => 'z',
         'ź' => 'z',
         'ž' => 'z',
         'Ż' => 'Z',
         'Ź' => 'Z',
         'Ž' => 'Z',
         // accentuated ligatures
         'Ǽ' => 'A',
         'ǽ' => 'a',
      ];
      return strtr($str, $map);
   }

}
