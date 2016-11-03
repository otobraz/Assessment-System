<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opcao extends Model
{

   protected $table = 'opcoes';

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      'opcao',
      'pergunta_id'
   ];

   /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
   protected $hidden = [

   ];

   public function pergunta(){
      return $this->belongsTo('App\Models\Pergunta');
   }

   public function RespostasMultiplaEscolha(){
      return $this->belongsToMany('App\Models\RespotasMultiplaEscolha', 'opcao_resposta_multipla_escolha', 'opcao_id', 'resposta_me_id');
   }
}
