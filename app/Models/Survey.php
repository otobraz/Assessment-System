<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{

   protected $table = 'surveys';

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      'name',
      'description'
   ];

   /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
   protected $hidden = [

   ];

   public function section(){
      return $this->belongsTo('App\Models\Section');
   }

   public function questions(){
      return $this->belongsToMany('App\Models\Question');
   }

   public function professor(){
      return $this->belongsTo('App\Models\Professor');
   }
}
