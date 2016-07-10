<?php

namespace ShareYourThoughts;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

   protected $table = "users";
   // // The UFOP LDAP data
   // protected $username;
   // protected $first_name;
   // protected $last_name;
   // protected $email;
   // protected $group;
   // protected $role;
   // protected $password;
   //
   //
   // public function __construct($attributes){
   //    $this->username = $attributes['username'];
   //    $this->firstName = $attributes['firstName'];
   //    $this->lastName = $attributes['lastName'];
   //    $this->email = $attributes['email'];
   //    $this->group = $attributes['group'];
   //    $this->role = $attribute['role'];
   //    $this->password = $attributes['password'];
   // }
   //
   // /**
   // * The attributes that are mass assignable.
   // *
   // * @var array
   // */
   protected $fillable = [
      'username',
      'first_name',
      'last_name',
      'email',
      'group',
      'role_id'
   ];

   /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
   protected $hidden = [
      'password'
   ];
}
