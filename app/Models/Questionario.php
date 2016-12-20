<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questionario extends Model
{

   protected $table = 'questionarios';

   /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   protected $fillable = [
      'titulo',
      'descricao',
      'professor_id'
   ];

   /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
   protected $hidden = [

   ];

   public function turmas(){
      return $this->belongsToMany('App\Models\Turma')->withPivot('id', 'aberto')->withTimestamps();
   }

   public function turmasQuestionariosAbertos(){
      return $this->belongsToMany('App\Models\Turma')->withPivot('id', 'aberto')->withTimestamps()->wherePivot('aberto', 1);
   }

   public function perguntas(){
      return $this->belongsToMany('App\Models\Pergunta');
   }

   public function professor(){
      return $this->belongsTo('App\Models\Professor');
   }

   // public function turmasOrderedByDisciplina()
   // {
   //    return $this->turmas()->join('disciplinas', 'turmas.disciplina_id', '=', 'disciplinas.id')
   //    ->orderBy("disciplinas.disciplina", "asc")
   //    ->get();
   // }

}
