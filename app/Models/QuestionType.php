<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{

   protected $table = 'question_types';

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

   public function questions(){
      return $this->hasMany('App\Models\Question', 'type_id');
   }

}
