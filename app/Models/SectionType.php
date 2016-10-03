<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionType extends Model
{

   protected $table = 'section_types';

   protected $fillable = [
      'type'
   ];

   /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
   protected $hidden = [

   ];

   public function sections(){
      return $this->hasMany('App\Models\Section');
   }


}
