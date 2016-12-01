<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionSurveyTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('questionario_turma', function (Blueprint $table) {
         $table->increments('id');
         $table->tinyInteger('aberto')->default(1);
         $table->integer('questionario_id')->unsigned();
         $table->integer('turma_id')->unsigned();

         // $table->unique(['questionario_id', 'turma_id']);

         $table->foreign('turma_id')->references('id')->on('turmas');
         $table->foreign('questionario_id')->references('id')->on('questionarios');

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
      Schema::drop('questionario_turma');
   }
}
