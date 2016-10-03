<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{

   protected $table = 'professors';

   protected $fillable = [
      'username',
      'first_name',
      'last_name',
      'email',
      'department_id'
   ];

   /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
   protected $hidden = [

   ];

   public function department(){
      return $this->belongsTo('App\Models\Department');
   }

   public function sections(){
      return $this->belongsToMany('App\Models\Section');
   }

   public function areas(){
      return $this->belongsToMany('App\Models\Area');
   }

}
