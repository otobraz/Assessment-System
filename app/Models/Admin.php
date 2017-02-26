<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{

   protected $table = 'admins';

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      'usuario',
      'nome',
      'sobrenome',
      'email',
      'tipo_id'
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

   public function tipo(){
      return $this->belongsTo('App\Models\TipoAdmin');
   }

}
