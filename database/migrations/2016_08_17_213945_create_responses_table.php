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
         $table->integer('section_id')->unsigned();
         $table->integer('student_id')->unsigned();

         $table->foreign(['section_id', 'student_id'])->references(['section_id', 'student_id'])->on('section_student');
         $table->foreign(['section_id', 'survey_id'])->references(['section_id', 'survey_id'])->on('section_survey');

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
