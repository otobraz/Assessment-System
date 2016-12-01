<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('perguntas', function (Blueprint $table) {
         $table->increments('id');
         $table->string('pergunta');
         $table->integer('tipo_id')->unsigned();
         $table->integer('professor_id')->unsigned()->nullable();

         $table->foreign('tipo_id')->references('id')->on('tipos_pergunta');
         $table->foreign('professor_id')->references('id')->on('professores');
         
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
      Schema::drop('perguntas');
   }
}
