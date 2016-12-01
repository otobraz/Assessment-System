<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('disciplinas', function (Blueprint $table) {
         $table->increments('id');
         $table->string('cod_disciplina', 6)->unique();
         $table->string('disciplina', 100);
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
      Schema::drop('disciplinas');
   }
}
