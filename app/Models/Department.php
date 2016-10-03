<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{

   protected $table = 'departments';

   protected $fillable = [
      'department',
      'initials'
   ];

   /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
   protected $hidden = [

   ];

   public function professors(){
      return $this->hasMany('App\Models\Professor');
   }
}
