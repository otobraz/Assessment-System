<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionSurveyTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('pergunta_questionario', function (Blueprint $table) {
         $table->integer('pergunta_id')->unsigned();
         $table->integer('questionario_id')->unsigned();

         $table->primary(['pergunta_id', 'questionario_id']);

         $table->foreign('questionario_id')->references('id')->on('questionarios');
         $table->foreign('pergunta_id')->references('id')->on('perguntas');

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
      Schema::drop('pergunta_questionario');
   }
}
