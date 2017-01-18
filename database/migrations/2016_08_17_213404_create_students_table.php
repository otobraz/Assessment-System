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
      Schema::create('alunos', function (Blueprint $table) {
         $table->increments('id');
         $table->string('matricula', 9)->unique();
         $table->string('usuario', 11)->unique();
         $table->string('nome', 20)->nullable();
         $table->string('sobrenome', 100)->nullable();
         $table->string('email', 50)->unique()->nullable();
         $table->integer('curso_id')->unsigned();

         $table->foreign('curso_id')->references('id')->on('cursos');

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
      Schema::drop('alunos');
   }
}
