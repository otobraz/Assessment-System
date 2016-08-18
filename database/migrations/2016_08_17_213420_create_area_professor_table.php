<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaProfessorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_professor', function (Blueprint $table) {
            $table->integer('area_id')->unsigned();
            $table->integer('professor_id')->unsigned();

            $table->primary(['area_id', 'professor_id']);

            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('professor_id')->references('id')->on('professors');

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
        Schema::drop('area_professor');
    }
}
