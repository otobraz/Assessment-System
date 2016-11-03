<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoTurma extends Model
{

   protected $table = 'tipos_turma';

   protected $fillable = [
      'tipo'
   ];

   /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
   protected $hidden = [

   ];

   public function turmas(){
      return $this->hasMany('App\Models\Turma', 'tipo_id');
   }


}
