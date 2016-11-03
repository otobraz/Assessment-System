<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionStudentTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('aluno_turma', function (Blueprint $table) {
         $table->integer('aluno_id')->unsigned();
         $table->integer('turma_id')->unsigned();


         $table->primary(['aluno_id', 'turma_id']);

         $table->foreign('turma_id')->references('id')->on('turmas');
         $table->foreign('aluno_id')->references('id')->on('alunos');

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
      Schema::drop('aluno_turma');
   }
}
