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

   public function scopeOrderByProfessor($query){
      return $query->join('professores','professor_id', '=', 'professores.id')
      ->orderBy("nome", "asc")->orderBy("sobrenome", "asc")->select('questionarios.*');
   }

   // public function scopeAbertos($query){
   //    return $query->join('questionario_turma', 'questionario_turma.questionario_id', '=', 'questionarios.id')
   //       ->where('questionario_turma.questionario_id', $this->id)
   //       ->where('questionario_turma.aberto', 1);
   // }

}
