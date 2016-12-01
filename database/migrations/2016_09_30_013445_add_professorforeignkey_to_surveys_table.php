<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfessorforeignkeyToSurveysTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::table('questionarios', function (Blueprint $table) {

         $table->integer('professor_id')->unsigned()->after('descricao');

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
