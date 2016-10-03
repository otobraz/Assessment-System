<?php

namespace App\Models;

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

   public function sectionType(){
      return $this->belongsTo('App\Models\SectionType');
   }

   public function course(){
      return $this->belongsTo('App\Models\Course');
   }

   public function students(){
      return $this->belongsToMany('App\Models\Students');
   }

   public function professors(){
      return $this->belongsToMany('App\Models\Professors');
   }
}
