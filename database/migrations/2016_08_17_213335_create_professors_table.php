<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessorsTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('professores', function (Blueprint $table) {
         $table->increments('id');
         $table->string('usuario', 11)->unique();
         $table->string('nome', 20)->nullable();
         $table->string('sobrenome', 50)->nullable();
         $table->string('email', 50)->unique()->nullable();
         $table->integer('departamento_id')->unsigned();

         $table->foreign('departamento_id')->references('id')->on('departamentos');

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
      Schema::drop('professores');
   }
}
