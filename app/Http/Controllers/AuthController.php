<?php

namespace ShareYourThoughts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use DB;


class AuthController extends Controller{

   public function getLdapUser($ldapData = null, $username = null){
      $ds = ldap_connect($ldapData->server); // your ldap server
      $bind = ldap_bind($ds, $ldapData->cn . "," . $ldapData->domain, base64_decode("$ldapData->bind_dn_password"));
      if ($bind) {
         $filter = "(" . $ldapData->user_id . "=" . $username . ")"; // this command requires some filter
         $justThese = array(
            $ldapData->user_id,
            $ldapData->user_given_name,
            $ldapData->user_last_name,
            $ldapData->user_email,
            $ldapData->user_group,
            $ldapData->user_password
         ); // the attributes to pull, which is much more efficient than pulling all attributes if you don't do this
         $sr = ldap_search($ds, $ldapData->domain, $filter, $justThese);
         $entry = ldap_get_entries($ds, $sr);
         if ($entry['count'] > 0) {
            return $entry;
         }
         return null;
      }
      return null;
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
         ->select('username', 'name', 'last_name', 'email', 'group')->get()){
         if((array)$user[0] == $authenticatedUser){
            $userTable->update($authenticatedUser);
         }
      }else{
         $userTable->insertGetId($user);
      }
   }

   public function getLogin(){
      if(session('username')){
         // Redirect to user's home page
         return redirect()->action('HomeController@getUsersHome');
      }else {
         return view('auth.login');
      }
   }

   public function postLogin(Request $request){
      if(session('username')){
         // Redirect to user's home page
         return redirect()->action('HomeController@getUsersHome');
      }else {
         $ldapData = DB::table('ldap_data')->first();
         $ldapUser = $this->getLdapUser($ldapData, $request->input('username'));
         $userPassword = substr($ldapUser[0][$ldapData->user_password][0], 5);
         if ($this->isPasswordValid($userPassword, $request->input('password'))){
            $authenticatedUser = array(
               'username' => $ldapUser[0][$ldapData->user_id][0],
               'name' => $ldapUser[0][$ldapData->user_given_name][0],
               'last_name' => $ldapUser[0][$ldapData->user_last_name][0],
               'email' => $ldapUser[0][$ldapData->user_email][0],
               'group' => $ldapUser[0][$ldapData->user_group][0],
            );
            $this->insertUpdateUser($authenticatedUser);
            $request->session()->put($authenticatedUser);
            return redirect()->action('HomeController@getUsersHome');
         }
      }
   }

}
