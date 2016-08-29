<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

   protected $table = 'questions';

   protected $fillable = [
      'question',
      'type_id'
   ];

   /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
   protected $hidden = [

   ];
}
