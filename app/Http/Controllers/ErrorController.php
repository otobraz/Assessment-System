<?php

namespace ShareYourThoughts\Http\Controllers;

use Illuminate\Http\Request;
use Adldap\Contracts\AdldapInterface;

class ErrorController extends Controller
{

   // Server Unaivalable Error
   public function e503() {
      return redirect('errors/503');
   }
}
