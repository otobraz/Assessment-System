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
         $table->integer('disciplina_id')->unsigned();
         // $table->integer('tipo_id')->unsigned();

         $table->foreign('disciplina_id')->references('id')->on('disciplinas');
         $table->foreign('tipo_id')->references('id')->on('tipos_turma');

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
