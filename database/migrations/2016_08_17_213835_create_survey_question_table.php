<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_survey', function (Blueprint $table) {
            $table->integer('survey_id')->unsigned();
            $table->integer('question_id')->unsigned();

            $table->primary(['survey_id', 'question_id']);

            $table->foreign('survey_id')->references('id')->on('surveys');
            $table->foreign('question_id')->references('id')->on('questions');

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
        Schema::drop('survey_question');
    }
}
