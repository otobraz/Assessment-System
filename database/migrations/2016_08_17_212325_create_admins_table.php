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
         $table->string('usuario', 11)->unique();
         $table->string('nome', 20);
         $table->string('sobrenome', 100);
         $table->string('email', 50)->unique();

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
