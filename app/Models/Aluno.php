<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{

   protected $table = 'alunos';

   protected $fillable = [
      'usuario',
      'matricula',
      'nome',
      'sobrenome',
      'email',
      'senha',
      'curso_id'
   ];

   /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
   protected $hidden = [

   ];

   public function getNomeCompletoAttribute(){
      return $this->nome . " " . $this->sobrenome;
   }

   public function curso(){
      return $this->belongsTo('App\Models\Curso');
   }

   public function turmas(){
      return $this->belongsToMany('App\Models\Turma');
   }

}
