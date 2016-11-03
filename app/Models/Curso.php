<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{

   protected $table = 'cursos';

   protected $fillable = [
      'cod_curso',
      'curso'
   ];

   /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
   protected $hidden = [

   ];

   public function alunos(){
      return $this->hasMany('App\Models\Student');
   }

}
