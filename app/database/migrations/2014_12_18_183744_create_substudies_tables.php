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
			$table->timestamps();

			$table->integer('study_id')->unsigned();
			$table->foreign('study_id')->references('id')->on('studies');

			$table->text('name');
			$table->text('description')->nullable();
			$table->text('comment')->nullable();

			$table->boolean('trigger_is_event');
			$table->boolean('trigger_is_timefix');
			$table->integer('trigger_time_interval');

		});

        Schema::create('surveyperiods', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();

			$table->integer('substudy_id')->unsigned();
			$table->foreign('substudy_id')->references('id')->on('substudies');

			$table->dateTime('start_date');
			$table->dateTime('end_date');
			$table->string('weekday_list');
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
