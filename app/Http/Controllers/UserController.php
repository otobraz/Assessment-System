<?php

namespace ShareYourThoughts\Http\Controllers;

use Illuminate\Http\Request;
use Adldap\Contracts\AdldapInterface;

class UserController extends Controller
{
      /**
   * @var Adldap
   */
   protected $adldap;

   /**
   * Constructor.
   *
   * @param AdldapInterface $adldap
   */
   public function __construct(AdldapInterface $adldap)
   {
      $this->adldap = $adldap;
   }

   /**
   * Displays the all LDAP users.
   *
   * @return \Illuminate\View\View
   */
   public function index()
   {
      $users = $this->adldap->getDefaultProvider()->search()->where('uid', '=', '09647636644')->get();

      return view('ldap_tester', compact('users'));
   }
}
