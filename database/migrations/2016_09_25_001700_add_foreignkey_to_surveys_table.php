<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignkeyToSurveysTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::table('surveys', function (Blueprint $table) {
         $table->integer('section_id')->unsigned()->after('description');

         $table->foreign('section_id')->references('id')->on('sections');
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
