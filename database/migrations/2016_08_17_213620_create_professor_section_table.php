<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessorSectionTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('professor_turma', function (Blueprint $table) {
         $table->integer('professor_id')->unsigned();
         $table->integer('turma_id')->unsigned();


         $table->primary(['professor_id', 'turma_id']);

         $table->foreign('turma_id')->references('id')->on('turmas');
         $table->foreign('professor_id')->references('id')->on('professores');

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
      Schema::drop('professor_turma');
   }
}
