<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionRulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rules', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('question_id')->unsigned();
			$table->foreign('question_id')->references('id')->on('questions');

			$table->integer('questiongroup_id')->unsigned();
			$table->foreign('questiongroup_id')->references('id')->on('questiongroups');

			$table->integer('id_in_questiongroup')->unsigned();

			$table->boolean('is_answer_boolean');
			$table->boolean('answer_boolean');

			$table->integer('optionchoice_id')->unsigned()->nullable();
			$table->foreign('optionchoice_id')->references('id')->on('optionchoices');

			$table->timestamps();
		});

	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rules');
	}

}
