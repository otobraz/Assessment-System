<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

   protected $table = 'students';

   protected $fillable = [
      'username',
      'first_name',
      'last_name',
      'email',
      'major_id'
   ];

   /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
   protected $hidden = [

   ];

   public function major(){
      return $this->belongsTo('App\Major');
   }

}
