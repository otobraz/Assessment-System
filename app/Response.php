<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{

   protected $table = 'responses';

   protected $fillable = [
      'servey_id',
      'section_id',
      'student_id'
   ];

   /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
   protected $hidden = [

   ];
}
