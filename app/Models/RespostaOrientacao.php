<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespostaOrientacao extends Model
{

   protected $table = 'respostas_orientacao';

   protected $fillable = [
      'titulo',
      'descricao',
      'orientacao_id',
   ];

   /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
   protected $hidden = [

   ];

   public function orientacao(){
      
   }

}
