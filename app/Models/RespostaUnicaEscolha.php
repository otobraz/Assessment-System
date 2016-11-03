<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RespostaUnicaEscolha extends Model
{
   protected $table = 'respostas_unica_escolha';

   protected $fillable = [
      'opcao_id',
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

   public function resposta(){
      return $this->belongsTo('App\Models\Resposta');
   }

   public function pergunta(){
      return $this->belongsTo('App\Models\Pergunta');
   }
}
