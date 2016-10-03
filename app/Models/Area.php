<?php

namespace App\Models;

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

   public function professors(){
      return $this->belongsToMany('App\Models\Professor');
   }
}
