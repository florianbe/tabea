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
			$table->timestamps();

			$table->integer('id_in_substudy');

			$table->integer('substudy_id')->unsigned();
			$table->foreign('substudy_id')->references('id')->on('substudies');

			$table->text('name');
			$table->text('shortname');
			$table->text('description')->nullable();
			$table->text('comment')->nullable();
			$table->integer('sequence_indicator');

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
