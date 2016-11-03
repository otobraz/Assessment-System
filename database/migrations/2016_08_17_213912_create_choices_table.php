<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChoicesTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('opcoes', function (Blueprint $table) {
         $table->increments('id');
         $table->string('opcao');
         $table->integer('pergunta_id')->unsigned();

         $table->foreign('pergunta_id')->references('id')->on('perguntas');

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
      Schema::drop('opcoes');
   }
}
