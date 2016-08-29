<?php

namespace App;

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
      return $this->belongsTo('App\Department');
   }

}
