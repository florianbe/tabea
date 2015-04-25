<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubjectsAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('testsubjectnames', function (Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
		});

		$subjectnamedata = [
			['name'	=> 'zenon'],
			['name'	=> 'kleanthes'],
			['name'	=> 'ariston'],
			['name'	=> 'diogenes'],
			['name'	=> 'panaitos'],
			['name'	=> 'poseidonios'],
			['name'	=> 'seneca'],
			['name'	=> 'rufus'],
			['name'	=> 'epiktetos'],
			['name'	=> 'aurel']
		];

		DB::table('testsubjectnames')->insert($subjectnamedata);

		Schema::create('testsubjects', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name_text');
			$table->integer('name_counter');
			$table->timestamps();
		});

		Schema::create('answers', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('testsubject_id')->unsigned();
			$table->foreign('testsubject_id')->references('id')->on('testsubjects');

			$table->integer('question_id')->unsigned();
			$table->foreign('question_id')->references('id')->on('questions');

			$table->integer('answergroup');

			$table->string('answer');

			$table->dateTime('signaled_at')->nullable();
			$table->dateTime('answered_at');

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
		Schema::drop('answers');
		Schema::drop('testsubjects');
		Schema::drop('testsubjectnames');
	}

}
