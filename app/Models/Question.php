<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

   protected $table = 'questions';

   protected $fillable = [
      'question',
      'type_id'
   ];

   /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
   protected $hidden = [

   ];

   public function type(){
      return $this->belongsTo('App\Models\QuestionType', 'type_id');
   }

   public function surveys(){
      return $this->belongsToMany('App\Models\Survey');
   }

   public function choices(){
      return $this->hasMany('App\Models\Choice');
   }

}
