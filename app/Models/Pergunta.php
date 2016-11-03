<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pergunta extends Model
{

   protected $table = 'perguntas';

   protected $fillable = [
      'pergunta',
      'tipo_id'
   ];

   /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
   protected $hidden = [

   ];

   public function tipo(){
      return $this->belongsTo('App\Models\TipoPergunta', 'tipo_id');
   }

   public function questionarios(){
      return $this->belongsToMany('App\Models\Questionario');
   }

   public function opcoes(){
      return $this->hasMany('App\Models\Opcao');
   }

   public function professor(){
      return $this->belongsTo('App\Models\Professor');
   }

}
