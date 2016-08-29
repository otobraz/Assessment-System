<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{

   protected $table = 'areas';

   protected $fillable = [
      'area'
   ];

   /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
   protected $hidden = [

   ];
}
