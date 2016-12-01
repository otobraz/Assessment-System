<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
   protected $table = 'disciplinas';

   protected $fillable = [
      'cod_disciplina',
      'disciplina',
      'departamento_id'
   ];

   /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
   protected $hidden = [

   ];

   public function turmas(){
      return $this->hasMany('App\Models\Turma');
   }

   public function departamento(){
      return $this->belongsTo('App\Models\Departamento');
   }
}
