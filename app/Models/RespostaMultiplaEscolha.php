<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RespostaMultiplaEscolha extends Model
{
   protected $table = 'respostas_multipla_escolha';

   protected $fillable = [
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

   public function opcoes(){
      return $this->belongsToMany('App\Models\Opcao', 'opcao_resposta_multipla_escolha', 'resposta_me_id', 'opcao_id');
   }
}
