<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionProfessorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_professor', function (Blueprint $table) {
            $table->integer('section_id')->unsigned();
            $table->integer('professor_id')->unsigned();

            $table->primary(['section_id', 'professor_id']);

            $table->foreign('section_id')->references('id')->on('sections');
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
        Schema::drop('section_professor');
    }
}
