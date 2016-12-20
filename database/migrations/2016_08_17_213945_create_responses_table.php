<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsesTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('respostas', function (Blueprint $table) {
         $table->increments('id');

         $table->integer('aluno_id')->unsigned();
         $table->integer('questionario_id')->unsigned();
         $table->integer('turma_id')->unsigned();
         $table->integer('questionario_turma_id')->unsigned();

         $table->unique(['aluno_id', 'questionario_turma_id']);

         $table->foreign('questionario_id')->references('id')->on('questionarios');
         $table->foreign('aluno_id')->references('id')->on('alunos');
         $table->foreign('turma_id')->references('id')->on('turmas');
         $table->foreign('questionario_turma_id')->references('id')->on('questionario_turma');

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
      Schema::drop('respostas');
   }
}
