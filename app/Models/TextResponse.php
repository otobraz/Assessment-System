<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TextResponse extends Model
{
   protected $table = 'text_responses';

   protected $fillable = [
      'response',
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
}
