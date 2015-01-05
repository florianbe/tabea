<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questiontypes', function(Blueprint $table)
		{
			$table->increments('id');

			$table->text('code');
			$table->text('mandatory_restrictions');

		});

		// Fill with predefined states
		$type_data = [
			['code' => 'NUMERIC', 		'mandatory_restrictions' => 'min_numeric;max_numeric;step_numeric'],
			['code' => 'SLIDER', 		'mandatory_restrictions' => 'min_numeric;max_numeric;step_numeric'],
			['code' => 'TEXT', 			'mandatory_restrictions' => ''],
			['code' => 'BOOLEAN', 		'mandatory_restrictions' => ''],
			['code' => 'SINGLECHOICE', 	'mandatory_restrictions' => ''],
			['code' => 'MULTICHOICE', 	'mandatory_restrictions' => 'min_integer;max_integer'],
			['code' => 'MOODMAP',		'mandatory_restrictions' => '']
		];

		DB::table('questiontypes')->insert($type_data);

		Schema::create('questionrestrictions', function(Blueprint $table)
		{
			$table->increments('id');

			$table->decimal('min_numeric');
			$table->decimal('max_numeric');
			$table->decimal('step_numeric');
			$table->integer('min_integer');
			$table->integer('max_integer');
			$table->integer('step_integer');

		});

		Schema::create('optiongroups', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('code')->nullable();
			$table->boolean('is_predefined');
		});

		$optiongroups_data = [
			['code' => 'LIKERT_4', 	'is_predefined' => '1'],
			['code' => 'LIKERT_5', 	'is_predefined' => '1'],
			['code' => 'LIKERT_6',  'is_predefined' => '1'],
			['code' => 'LIKERT_7', 	'is_predefined' => '1'],
			['code' => 'LIKERT_10', 'is_predefined' => '1'],
		];

		DB::table('optiongroups')->insert($optiongroups_data);

		Schema::create('optionchoices', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('code')->nullable();
			$table->text('description')->nullable();
			$table->text('value');

			$table->integer('optiongroup_id')->unsigned();
			$table->foreign('optiongroup_id')->references('id')->on('optiongroups');
		});

		$optionchoices = [
			['code' => 'LIKERT_4_1', 	'value' => '1',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_4')->get(['id'])[0]->id],
			['code' => 'LIKERT_4_2', 	'value' => '2',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_4')->get(['id'])[0]->id],
			['code' => 'LIKERT_4_3', 	'value' => '3',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_4')->get(['id'])[0]->id],
			['code' => 'LIKERT_4_4', 	'value' => '4',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_4')->get(['id'])[0]->id],
			['code' => 'LIKERT_5_1', 	'value' => '1',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_5')->get(['id'])[0]->id],
			['code' => 'LIKERT_5_2', 	'value' => '2',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_5')->get(['id'])[0]->id],
			['code' => 'LIKERT_5_3', 	'value' => '3',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_5')->get(['id'])[0]->id],
			['code' => 'LIKERT_5_4', 	'value' => '4',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_5')->get(['id'])[0]->id],
			['code' => 'LIKERT_5_5', 	'value' => '5',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_5')->get(['id'])[0]->id],
			['code' => 'LIKERT_6_1', 	'value' => '1',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_6')->get(['id'])[0]->id],
			['code' => 'LIKERT_6_2', 	'value' => '2',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_6')->get(['id'])[0]->id],
			['code' => 'LIKERT_6_3', 	'value' => '3',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_6')->get(['id'])[0]->id],
			['code' => 'LIKERT_6_4', 	'value' => '4',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_6')->get(['id'])[0]->id],
			['code' => 'LIKERT_6_5', 	'value' => '5',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_6')->get(['id'])[0]->id],
			['code' => 'LIKERT_6_6', 	'value' => '6',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_6')->get(['id'])[0]->id],
			['code' => 'LIKERT_7_1', 	'value' => '1',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_7')->get(['id'])[0]->id],
			['code' => 'LIKERT_7_2', 	'value' => '2',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_7')->get(['id'])[0]->id],
			['code' => 'LIKERT_7_3', 	'value' => '3',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_7')->get(['id'])[0]->id],
			['code' => 'LIKERT_7_4', 	'value' => '4',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_7')->get(['id'])[0]->id],
			['code' => 'LIKERT_7_5', 	'value' => '5',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_7')->get(['id'])[0]->id],
			['code' => 'LIKERT_7_6', 	'value' => '6',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_7')->get(['id'])[0]->id],
			['code' => 'LIKERT_7_7', 	'value' => '7',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_7')->get(['id'])[0]->id],
			['code' => 'LIKERT_10_1', 	'value' => '1',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_10')->get(['id'])[0]->id],
			['code' => 'LIKERT_10_2', 	'value' => '2',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_10')->get(['id'])[0]->id],
			['code' => 'LIKERT_10_3', 	'value' => '3',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_10')->get(['id'])[0]->id],
			['code' => 'LIKERT_10_4', 	'value' => '4',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_10')->get(['id'])[0]->id],
			['code' => 'LIKERT_10_5', 	'value' => '5',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_10')->get(['id'])[0]->id],
			['code' => 'LIKERT_10_6', 	'value' => '6',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_10')->get(['id'])[0]->id],
			['code' => 'LIKERT_10_7', 	'value' => '7',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_10')->get(['id'])[0]->id],
			['code' => 'LIKERT_10_8', 	'value' => '8',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_10')->get(['id'])[0]->id],
			['code' => 'LIKERT_10_9', 	'value' => '9',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_10')->get(['id'])[0]->id],
			['code' => 'LIKERT_10_10', 	'value' => '10','optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_10')->get(['id'])[0]->id],
		];

		DB::table('optionchoices')->insert($optionchoices);

		Schema::create('questions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('name');
			$table->text('shortname');
			$table->text('text');
			$table->text('comment')->nullable();
			$table->integer('sequence_indicator');
			$table->integer('id_in_questiongroup');
			$table->boolean('answer_required');

			$table->integer('questiongroup_id')->unsigned();
			$table->foreign('questiongroup_id')->references('id')->on('questiongroups');

			$table->integer('questiontype_id')->unsigned();
			$table->foreign('questiontype_id')->references('id')->on('questiontypes');

			$table->integer('questionrestriction_id')->unsigned();
			$table->foreign('questionrestriction_id')->references('id')->on('questionrestrictions');

			$table->integer('optiongroup_id')->unsigned()->nullable();
			$table->foreign('optiongroup_id')->references('id')->on('optiongroups');

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
		Schema::drop('questions');
		Schema::drop('optionchoices');
		Schema::drop('optiongroups');
		Schema::drop('questionrestrictions');
		Schema::drop('questiontypes');
	}

}
