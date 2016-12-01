<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{

   protected $table = 'turmas';

   protected $fillable = [
      'ano',
      'semestre',
      'disciplina_id',
      'cod_turma'
   ];

   /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
   protected $hidden = [

   ];

   public function disciplina(){
      return $this->belongsTo('App\Models\Disciplina');
   }

   public function alunos(){
      return $this->belongsToMany('App\Models\Aluno');
   }

   public function professores(){
      return $this->belongsToMany('App\Models\Professor');
   }

   public function questionarios(){
      return $this->belongsToMany('App\Models\Questionario')->withPivot('id', 'aberto')->withTimestamps();
   }

}
