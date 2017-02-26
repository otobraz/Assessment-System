<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('turmas', function (Blueprint $table) {

         $table->increments('id');
         $table->integer('ano');
         $table->integer('semestre');
         $table->integer('cod_turma');
         $table->integer('disciplina_id')->unsigned();
         $table->integer('departamento_id')->unsigned();

         $table->unique(['ano', 'semestre', 'cod_turma', 'disciplina_id']);

         // $table->integer('tipo_id')->unsigned();

         $table->foreign('disciplina_id')->references('id')->on('disciplinas');
         $table->foreign('departamento_id')->references('id')->on('departamento');
         // $table->foreign('tipo_id')->references('id')->on('tipos_turma');

         $table->timestamp('updated_at');
         $table->timestamp('created_at')->useCurrent();
      });
   }

   /**
   * Reverse the migrations.
   *
   * @return void
   */
   public function down()
   {
      Schema::drop('turmas');
   }
}
