<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseMajorTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('course_major', function (Blueprint $table) {
         $table->integer('course_id')->unsigned();
         $table->integer('major_id')->unsigned();

         $table->primary(['course_id', 'major_id']);

         $table->foreign('course_id')->references('id')->on('courses');
         $table->foreign('major_id')->references('id')->on('majors');

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
      Schema::drop('course_major');
   }
}
