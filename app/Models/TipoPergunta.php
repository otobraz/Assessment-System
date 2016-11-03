<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPergunta extends Model
{

   protected $table = 'tipos_pergunta';

   protected $fillable = [
      'tipo'
   ];

   /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
   protected $hidden = [

   ];

   public function perguntas(){
      return $this->hasMany('App\Models\Pergunta', 'tipo_id');
   }

}
