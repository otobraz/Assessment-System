<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MultipleChoiceResponse extends Model
{
   protected $table = 'multiple_choice_responses';

   protected $fillable = [
      'response_id',
      'question_id'
   ];

   /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
   protected $hidden = [

   ];

   public function response(){
      return $this->belongsTo('App\Models\Response');
   }

   public function question(){
      return $this->belongsTo('App\Models\Question');
   }

   public function choices(){
      return $this->belongsToMany('App\Models\Choice', 'choice_multiple_choice_response', 'mc_response_id', 'choice_id');
   }
}
