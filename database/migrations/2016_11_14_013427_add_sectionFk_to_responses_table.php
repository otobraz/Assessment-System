<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSectionFkToResponsesTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::table('respostas', function (Blueprint $table) {

         $table->integer('turma_id')->unsigned();
         $table->foreign('turma_id')->references('id')->on('turmas');

      });
   }

   /**
   * Reverse the migrations.
   *
   * @return void
   */
   public function down()
   {
      //
   }
}
