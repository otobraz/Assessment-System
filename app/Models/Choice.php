<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{

   protected $table = 'choices';

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      'choice'
   ];

   /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
   protected $hidden = [

   ];

   public function question(){
      return $this->belongsTo('App\Models\Question');
   }

   public function multipleChoiceResponses(){
      return $this->belongsToMany('App\Models\MultipleChoiceResponses', 'choice_multiple_choice_response', 'choice_id', 'mc_response_id');
   }
}
