<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubstudiesTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('substudies', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('study_id')->unsigned();
			$table->foreign('study_id')->references('id')->on('studies');

			$table->integer('id_in_study');

			$table->text('name');

			$table->boolean('trigger_is_event');
			$table->boolean('trigger_is_timefix');
			$table->integer('trigger_time_interval');

			$table->text('description')->nullable();
			$table->text('comment')->nullable();
			$table->integer('sequence_indicator');

			$table->timestamps();

		});

        Schema::create('surveyperiods', function(Blueprint $table)
        {
            $table->increments('id');

			$table->integer('id_in_substudy');

			$table->integer('substudy_id')->unsigned();
			$table->foreign('substudy_id')->references('id')->on('substudies');

			$table->integer('sequence_indicator');
			$table->dateTime('start_date');
			$table->dateTime('end_date');
			$table->string('weekday_list');

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
        Schema::drop('surveyperiods');
        Schema::drop('substudies');
	}

}
