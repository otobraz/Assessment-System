<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
   protected $table = 'courses';

   protected $fillable = [
      'code',
      'course'
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

   public function majors(){
      return $this->belongsToMany('App\Models\Major');
   }
}
