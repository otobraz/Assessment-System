<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMultipleChoiceResponsesTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('multiple_choice_responses', function (Blueprint $table) {
         $table->increments('id');
         $table->integer('response_id')->unsigned();
         $table->integer('question_id')->unsigned();

         $table->unique( ['response_id','question_id']);

         $table->foreign('response_id')->references('id')->on('responses');
         $table->foreign('question_id')->references('id')->on('questions');

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
      Schema::drop('multiple_choice_responses');
   }
}
