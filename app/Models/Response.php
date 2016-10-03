<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{

   protected $table = 'responses';

   protected $fillable = [
      'survey_id',
      'student_id'
   ];

   /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
   protected $hidden = [

   ];

   public function student(){
      return $this->belongsTo('App\Models\Students');
   }

   public function survey(){
      return $this->belongsTo('App\Models\Survey');
   }
}
