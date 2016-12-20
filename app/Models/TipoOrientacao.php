<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoOrientacao extends Model
{

   protected $table = 'tipos_orientacao';

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

   public function orientacoes(){
      return $this->hasMany('App\Models\Orientacao', 'tipo_id');
   }

}
