<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orientacao extends Model
{

   protected $table = 'orientacoes';

   protected $fillable = [
      'descricao',
      'aluno_id',
      'professor_id',
      'tipo_id',
      'status',
      'questionario_aberto'
   ];

   /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
   protected $hidden = [

   ];

   public function isOwner($id){
      return $this->professor_id == $id;
   }

   public function aluno(){
      return $this->belongsTo('App\Models\Aluno');
   }

   public function professor(){
      return $this->belongsTo('App\Models\Professor');
   }

   public function tipo(){
      return $this->belongsTo('App\Models\TipoOrientacao');
   }

   public function scopeEmAndamento($query){
      return $query->where('status', 1);
   }

}
