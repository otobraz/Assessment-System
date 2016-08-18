<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('sections', function (Blueprint $table) {
         $table->increments('id');
         $table->integer('year');
         $table->integer('semester');
         $table->integer('course_id')->unsigned();
         $table->integer('type_id')->unsigned();

         $table->foreign('course_id')->references('id')->on('courses');
         $table->foreign('type_id')->references('id')->on('section_types');

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
      Schema::drop('sections');
   }
}
