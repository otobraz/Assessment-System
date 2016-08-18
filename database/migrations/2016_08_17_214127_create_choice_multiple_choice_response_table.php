<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChoiceMultipleChoiceResponseTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('choice_multiple_choice_response', function (Blueprint $table) {
         $table->integer('choice_id')->unsigned();
         $table->integer('mc_response_id')->unsigned();

         $table->primary(['choice_id', 'mc_response_id']);

         $table->foreign('choice_id')->references('id')->on('choices');
         $table->foreign('mc_response_id')->references('id')->on('multiple_choice_responses');

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
      Schema::drop('choice_multiple_choice_response');
   }
}
