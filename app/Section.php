<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

   protected $table = 'sections';

   protected $fillable = [
      'year',
      'semester',
      'course_id',
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
