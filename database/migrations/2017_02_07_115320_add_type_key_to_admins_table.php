<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeKeyToAdminsTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {

      Schema::table('admins', function (Blueprint $table) {

         $table->integer('tipo_id')->unsigned()->after('email');
         $table->foreign('tipo_id')->references('id')->on('tipos_admin');

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
