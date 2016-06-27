<?php

namespace ShareYourThoughts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use DB;


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

   public function insertUpdateUser($authenticatedUser){
      $userTable = DB::table('users');
      if($user = $userTable->where('username', $authenticatedUser['username'])
         ->select('username', 'name', 'last_name', 'email', 'group', 'type')->get()){
         if((array)$user[0] == $authenticatedUser){
            $userTable->update($authenticatedUser);
         }
      }else{
         $userTable->insertGetId($authenticatedUser);
      }
   }

   public function getLogin(Request $request){
      if($request->session()->has('username')){
         // Redirect to user's home page
         return redirect()->action('HomeController@getUsersHome');
      }else {
         return view('auth.login');
      }
   }

   public function postLogin(Request $request){
      if($request->session()->has('username')){
         // Redirect to user's home page
         return redirect()->action('HomeController@getUsersHome');
      }else {
         $ldapData = config('my_config.ldapData');
         $ldapUserGroups = config('my_config.userGroups');
         $ldapUser = $this->getLdapUser($ldapData, $request->input('username'));
         if($type = $ldapUserGroups[$ldapUser[0][$ldapData['group_field']][0]]){
            $userPassword = substr($ldapUser[0][$ldapData['password_field']][0], 5);
            if ($this->isPasswordValid($userPassword, $request->input('password'))){
               $authenticatedUser = array(
                  'username' => $ldapUser[0][$ldapData['id_field']][0],
                  'name' => $ldapUser[0][$ldapData['given_name_field']][0],
                  'last_name' => $ldapUser[0][$ldapData['last_name_field']][0],
                  'email' => $ldapUser[0][$ldapData['email_field']][0],
                  'group' => $ldapUser[0][$ldapData['group_field']][0],
                  'type' => $type
               );
               $this->insertUpdateUser($authenticatedUser);
               $request->session()->put($authenticatedUser);
               return redirect()->action('HomeController@getUsersHome');
            }
            return redirect('login')->with('message', 'Usuário e/ou Senha inválidos');
         }
         return redirect('login')->with('message', 'Usuário Inválido');
      }
   }

}
