<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChoicesTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('choices', function (Blueprint $table) {
         $table->increments('id');
         $table->string('choice');
         $table->integer('question_id')->unsigned();

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
      Schema::drop('choices');
   }
}
