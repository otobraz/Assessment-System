<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RespostaAberta extends Model
{
   protected $table = 'respostas_abertas';

   protected $fillable = [
      'resposta',
      'resposta_id',
      'pergunta_id'
   ];

   /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
   protected $hidden = [

   ];

   public function Resposta(){
      return $this->belongsTo('App\Models\Resposta');
   }

   public function Pergunta(){
      return $this->belongsTo('App\Models\Pergunta');
   }
}
