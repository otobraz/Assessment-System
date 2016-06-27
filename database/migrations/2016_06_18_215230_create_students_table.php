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
         $table->string('username')->unique();
         $table->string('given_name', 20);
         $table->string('last_name', 50);
         $table->string('email', 50)->unique();
         $table->string('group');
         $table->string('type')->default('1');
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
