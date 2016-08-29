<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('admins', function (Blueprint $table) {
         $table->increments('id');
         $table->string('username', 10);
         $table->string('first_name', 20);
         $table->string('last_name', 50);
         $table->string('email', 50)->unique();
         $table->string('password', 30);

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
      Schema::drop('admins');
   }
}
