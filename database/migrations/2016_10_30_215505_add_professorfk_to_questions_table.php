<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfessorfkToQuestionsTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::table('perguntas', function (Blueprint $table) {

         $table->integer('professor_id')->unsigned()->nullable()->after('tipo_id');

         $table->foreign('professor_id')->references('id')->on('professores');

      });
   }

   /**
   * Reverse the migrations.
   *
   * @return void
   */
   public function down()
   {
      //
   }
}
