<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveysTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('questionarios', function (Blueprint $table) {
         $table->increments('id');
         $table->string('titulo');
         $table->text('descricao');

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
      Schema::drop('questionarios');
   }
}
