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

			$table->timestamps();

		});

		// Fill with predefined states
		$type_data = [
			['code' => 'NUMERIC', 		'mandatory_restrictions' => 'min_numeric;max_numeric'],
			['code' => 'SLIDER', 		'mandatory_restrictions' => 'min_numeric;max_numeric;step_numeric'],
			['code' => 'TEXT', 			'mandatory_restrictions' => ''],
			['code' => 'BOOLEAN', 		'mandatory_restrictions' => ''],
			['code' => 'SINGLECHOICE', 	'mandatory_restrictions' => ''],
			['code' => 'MULTICHOICE', 	'mandatory_restrictions' => 'min_integer;max_integer;selfdef_choice'],
			['code' => 'MOODMAP',		'mandatory_restrictions' => '']
		];

		DB::table('questiontypes')->insert($type_data);



		Schema::create('optiongroups', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('code')->nullable();
			$table->boolean('is_predefined');
			$table->boolean('as_dropdown');

			$table->timestamps();
		});

		$optiongroups_data = [
			['code' => 'LIKERT_4', 	'is_predefined' => '1', 'as_dropdown' => '1'],
			['code' => 'LIKERT_5', 	'is_predefined' => '1', 'as_dropdown' => '1'],
			['code' => 'LIKERT_6',  'is_predefined' => '1', 'as_dropdown' => '0'],
			['code' => 'LIKERT_7', 	'is_predefined' => '1', 'as_dropdown' => '0'],
			['code' => 'LIKERT_10', 'is_predefined' => '1', 'as_dropdown' => '0']
		];

		DB::table('optiongroups')->insert($optiongroups_data);

		Schema::create('optionchoices', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('optiongroup_id')->unsigned();
			$table->foreign('optiongroup_id')->references('id')->on('optiongroups');

			$table->text('code')->nullable();
			$table->text('value');
			$table->text('description')->nullable();

			$table->timestamps();
		});

		$optionchoices = [
			['code' => 'LIKERT_4_1', 'description' => '--', 'value' => '1',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_4')->get(['id'])[0]->id],
			['code' => 'LIKERT_4_2', 'description' => '-',	'value' => '2',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_4')->get(['id'])[0]->id],
			['code' => 'LIKERT_4_3', 'description' => '+',	'value' => '3',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_4')->get(['id'])[0]->id],
			['code' => 'LIKERT_4_4', 'description' => '++',	'value' => '4',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_4')->get(['id'])[0]->id],
			['code' => 'LIKERT_5_1', 'description' => '--',	'value' => '1',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_5')->get(['id'])[0]->id],
			['code' => 'LIKERT_5_2', 'description' => '-',	'value' => '2',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_5')->get(['id'])[0]->id],
			['code' => 'LIKERT_5_3', 'description' => 'o',	'value' => '3',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_5')->get(['id'])[0]->id],
			['code' => 'LIKERT_5_4', 'description' => '+',	'value' => '4',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_5')->get(['id'])[0]->id],
			['code' => 'LIKERT_5_5', 'description' => '++',	'value' => '5',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_5')->get(['id'])[0]->id],
			['code' => 'LIKERT_6_1', 'description' => '1 - Stimme nicht zu',	'value' => '1',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_6')->get(['id'])[0]->id],
			['code' => 'LIKERT_6_2', 'description' => '2',	'value' => '2',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_6')->get(['id'])[0]->id],
			['code' => 'LIKERT_6_3', 'description' => '3',	'value' => '3',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_6')->get(['id'])[0]->id],
			['code' => 'LIKERT_6_4', 'description' => '4',	'value' => '4',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_6')->get(['id'])[0]->id],
			['code' => 'LIKERT_6_5', 'description' => '5',	'value' => '5',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_6')->get(['id'])[0]->id],
			['code' => 'LIKERT_6_6', 'description' => '6 - Stimme zu',	'value' => '6',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_6')->get(['id'])[0]->id],
			['code' => 'LIKERT_7_1', 'description' => '1 - Stimme nicht zu',	'value' => '1',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_7')->get(['id'])[0]->id],
			['code' => 'LIKERT_7_2', 'description' => '2',	'value' => '2',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_7')->get(['id'])[0]->id],
			['code' => 'LIKERT_7_3', 'description' => '3',	'value' => '3',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_7')->get(['id'])[0]->id],
			['code' => 'LIKERT_7_4', 'description' => '4 - Neutral',	'value' => '4',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_7')->get(['id'])[0]->id],
			['code' => 'LIKERT_7_5', 'description' => '5',	'value' => '5',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_7')->get(['id'])[0]->id],
			['code' => 'LIKERT_7_6', 'description' => '6',	'value' => '6',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_7')->get(['id'])[0]->id],
			['code' => 'LIKERT_7_7', 'description' => '7 - Stimme zu',	'value' => '7',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_7')->get(['id'])[0]->id],
			['code' => 'LIKERT_10_1', 'description' => '1 - Stimme nicht zu',	'value' => '1',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_10')->get(['id'])[0]->id],
			['code' => 'LIKERT_10_2', 'description' => '2',	'value' => '2',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_10')->get(['id'])[0]->id],
			['code' => 'LIKERT_10_3', 'description' => '3',	'value' => '3',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_10')->get(['id'])[0]->id],
			['code' => 'LIKERT_10_4', 'description' => '4',	'value' => '4',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_10')->get(['id'])[0]->id],
			['code' => 'LIKERT_10_5', 'description' => '5',	'value' => '5',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_10')->get(['id'])[0]->id],
			['code' => 'LIKERT_10_6', 'description' => '6',	'value' => '6',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_10')->get(['id'])[0]->id],
			['code' => 'LIKERT_10_7', 'description' => '7',	'value' => '7',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_10')->get(['id'])[0]->id],
			['code' => 'LIKERT_10_8', 'description' => '8',	'value' => '8',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_10')->get(['id'])[0]->id],
			['code' => 'LIKERT_10_9', 'description' => '9',	'value' => '9',	'optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_10')->get(['id'])[0]->id],
			['code' => 'LIKERT_10_10', 'description' => '10', 'value' => '10','optiongroup_id' => DB::table('optiongroups')->where('code', '=', 'LIKERT_10')->get(['id'])[0]->id],
		];

		DB::table('optionchoices')->insert($optionchoices);

		Schema::create('questions', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('questiongroup_id')->unsigned();
			$table->foreign('questiongroup_id')->references('id')->on('questiongroups');
			$table->integer('id_in_questiongroup');
			$table->integer('sequence_indicator');

			$table->text('shortname');
			$table->text('text');
			$table->boolean('answer_required');

			$table->text('comment')->nullable();
			
			$table->integer('questiontype_id')->unsigned();
			$table->foreign('questiontype_id')->references('id')->on('questiontypes');

			$table->integer('optiongroup_id')->unsigned()->nullable();
			$table->foreign('optiongroup_id')->references('id')->on('optiongroups');

			$table->timestamps();
		});

		Schema::create('questionrestrictions', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('question_id')->unsigned();
			$table->foreign('question_id')->references('id')->on('questions');

			$table->decimal('min_numeric')->nullable();
			$table->decimal('max_numeric')->nullable();
			$table->decimal('step_numeric')->nullable();
			$table->integer('min_integer')->nullable();
			$table->integer('max_integer')->nullable();
			$table->integer('step_integer')->nullable();

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
		Schema::drop('questionrestrictions');
		Schema::drop('questions');
		Schema::drop('optionchoices');
		Schema::drop('optiongroups');
		Schema::drop('questiontypes');
	}

}
