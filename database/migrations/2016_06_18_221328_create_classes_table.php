<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('classes', function (Blueprint $table) {
         $table->increments('id');
         $table->string('name', 50);
         $table->timestamp('updated_at');
         $table->timestamp('created_at')->useCurrent();

         // foreign key
         $table->integer('course_id')->unsigned();

         // constraints
         $table->foreign('course_id')->references('id')->on('courses');

      });
   }

   /**
   * Reverse the migrations.
   *
   * @return void
   */
   public function down()
   {
      Schema::drop('classes');
   }
}
