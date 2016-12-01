<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{

   protected $table = 'departamentos';

   protected $fillable = [
      'cod_departamento',
      'descricao'
   ];

   /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
   protected $hidden = [

   ];

   public function professores(){
      return $this->hasMany('App\Models\Professor');
   }
   public function disciplinas(){
      return $this->hasMany('App\Models\Disciplina');
   }
}
