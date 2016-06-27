<?php

namespace ShareYourThoughts;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{


   protected $table = "users";

   // The UFOP LDAP data
   protected $ldapData;

   protected $username;
   protected $name;
   protected $last_name;
   protected $email;
   protected $group;
   protected $password;


   public function __construct($attributes, $ldapData){
      $this->username = $attributes['username'];
      $this->name = $attributes['givenName'];
      $this->last_name = $attributes['lastName'];
      $this->email = $attributes['email'];
      $this->group = $attributes['group'];
      $this->password = $attributes['password'];
      $this->ldapData = $ldapData;
   }

   /**
     * @return string
     */
    public function getAuthIdentifierName()
    {
        // Return the name of unique identifier for the user (e.g. "id")
        return $ldapData['id_field'];
    }

    /**
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        // Return the unique identifier for the user (e.g. their ID, 123)
        return $this->username;
    }

    /**
     * @return string
     */
    public function getAuthPassword()
    {
        // Returns the (hashed) password for the user
        return $this->password;
    }

    /**
     * @return string
     */
    public function getRememberToken()
    {
        // Return the token used for the "remember me" functionality
    }

    /**
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        // Store a new token user for the "remember me" functionality
    }

    /**
     * @return string
     */
    public function getRememberTokenName()
    {
        // Return the name of the column / attribute used to store the "remember me" token
    }
}
