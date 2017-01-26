<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTituloKeyToOrientacoesTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::table('orientacoes', function (Blueprint $table) {

         $table->string('titulo', 100)->after('id');

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
