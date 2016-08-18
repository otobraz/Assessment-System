<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('students', function (Blueprint $table) {
         $table->increments('id');
         $table->string('username', 11)->unique();
         $table->string('first_name', 20);
         $table->string('last_name', 50);
         $table->string('email', 50)->unique();
         $table->integer('major_id')->unsigned();

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
      Schema::drop('students');
   }
}
