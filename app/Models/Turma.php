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

   public function departamento(){
      return $this->belongsTo('App\Models\Departamento');
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

   public function scopeOrderByDisciplina($query){
      return $query->join('disciplinas','disciplina_id', '=', 'disciplinas.id')
      ->orderBy("disciplinas.disciplina", "asc")->orderBy("cod_turma", "asc")->select('turmas.*');
   }

   public function scopeAbertos($query){
      return $query->join('questionarios', 'questionarios.id', '=', 'questionario_turma.questionario_id')
         ->where('questionario_turma.aberto', 1)->select('questionarios.titulo', 'turmas.*');
   }

}
