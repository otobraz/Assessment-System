<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuidancesTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('orientacoes', function (Blueprint $table) {
         $table->increments('id');

         $table->string('descricao');
         $table->tinyInteger('status')->default(1);
         $table->tinyInteger('questionario_liberado')->default(0);

         $table->integer('aluno_id')->unsigned();
         $table->integer('professor_id')->unsigned();
         $table->integer('tipo_id')->unsigned();

         $table->foreign('aluno_id')->references('id')->on('alunos');
         $table->foreign('professor_id')->references('id')->on('professores');
         $table->foreign('tipo_id')->references('id')->on('tipos_orientacao');

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
      Schema::drop('orientacoes');
   }
}
