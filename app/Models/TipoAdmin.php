<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoAdmin extends Model
{

   protected $table = 'tipos_admin';

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

   public function admins(){
      return $this->hasMany('App\Models\Admin', 'tipo_id');
   }
}
