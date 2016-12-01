<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{

   protected $table = 'professores';

   protected $fillable = [
      'usuario',
      'nome',
      'sobrenome',
      'email',
      'senha',
      'departamento_id',
      'areas_interesse'
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

   public function departamento(){
      return $this->belongsTo('App\Models\Departamento');
   }

   public function turmas(){
      return $this->belongsToMany('App\Models\Turma');
   }

   public function areas(){
      return $this->belongsToMany('App\Models\Area');
   }

   public function perguntas(){
      return $this->hasMany('App\Models\Pergunta');
   }

   public function questionarios(){
      return $this->hasMany('App\Models\Questionario');
   }

}
