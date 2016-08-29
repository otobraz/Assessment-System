<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{

   protected $table = 'choices';

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      'choice'
   ];

   /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
   protected $hidden = [

   ];

}
