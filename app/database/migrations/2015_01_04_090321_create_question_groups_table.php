<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questiongroups', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('substudy_id')->unsigned();
			$table->foreign('substudy_id')->references('id')->on('substudies');

			$table->integer('id_in_substudy');

			$table->text('name');
			$table->text('shortname');

			$table->integer('sequence_indicator');
			$table->boolean('random_questionorder');

			$table->text('description')->nullable();
			$table->text('comment')->nullable();

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
		Schema::drop('questiongroups');
	}

}
