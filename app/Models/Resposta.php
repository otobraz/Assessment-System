<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{

   protected $table = 'respostas';

   protected $fillable = [
      'questionario_id',
      'aluno_id',
      'turma_id',
      'questionario_turma_id'
   ];

   /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
   protected $hidden = [

   ];

   public function aluno(){
      return $this->belongsTo('App\Models\Alunos');
   }

   public function questionario(){
      return $this->belongsTo('App\Models\Questionario');
   }
}
