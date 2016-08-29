<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{

   protected $table = 'majors';

   protected $fillable = [
      'major',
      'initials'
   ];

   /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
   protected $hidden = [

   ];

   public function students(){
      return $this->hasMany('App\Student');
   }

}
