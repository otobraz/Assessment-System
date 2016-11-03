<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChoiceMultipleChoiceResponseTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('opcao_resposta_multipla_escolha', function (Blueprint $table) {
         $table->integer('opcao_id')->unsigned();
         $table->integer('resposta_me_id')->unsigned();

         $table->primary(['resposta_me_id', 'opcao_id']);

         $table->foreign('opcao_id')->references('id')->on('opcoes');
         $table->foreign('resposta_me_id')->references('id')->on('respostas_multipla_escolha');

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
      Schema::drop('opcao_resposta_multipla_escolha');
   }
}
