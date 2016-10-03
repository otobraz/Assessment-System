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
      Schema::create('responses', function (Blueprint $table) {
         $table->increments('id');

         $table->integer('survey_id')->unsigned();
         $table->integer('student_id')->unsigned();

         $table->unique(['survey_id', 'student_id']);

         $table->foreign('survey_id')->references('id')->on('surveys');
         $table->foreign('student_id')->references('id')->on('students');

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
      Schema::drop('responses');
   }
}
