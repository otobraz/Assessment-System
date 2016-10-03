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
      Schema::table('surveys', function (Blueprint $table) {
         $table->integer('professor_id')->unsigned()->after('description');

         $table->foreign('professor_id')->references('id')->on('professors');
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
