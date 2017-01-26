<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespostasOrientacaoTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('respostas_orientacao', function (Blueprint $table) {

         $table->increments('id');
         $table->integer('orientacao_id')->unsigned();

         $table->string('resposta1');
         $table->string('resposta2');
         $table->string('resposta3');
         $table->string('resposta4');
         $table->string('resposta5');
         $table->string('resposta6');
         $table->string('resposta7');
         $table->string('resposta8');
         $table->string('resposta9');
         $table->string('resposta10');

         $table->foreign('orientacao_id')->references('id')->on('orientacoes');

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
      Schema::drop('respostas_orientacao');
   }
}
