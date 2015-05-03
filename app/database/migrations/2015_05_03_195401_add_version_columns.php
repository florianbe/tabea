<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddVersionColumns extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('studies', function(Blueprint $table)
		{
			$table->integer('version');
		});

		Schema::table('substudies', function(Blueprint $table)
		{
			$table->integer('version');
		});

		Schema::table('questiongroups', function(Blueprint $table)
		{
			$table->integer('version');
		});

		Schema::table('rules', function(Blueprint $table)
		{
			$table->integer('version');
		});

		Schema::table('questions', function(Blueprint $table)
		{
			$table->integer('version');
		});

	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('studies', function(Blueprint $table)
		{
			$table->dropColumn('version');
		});

		Schema::table('substudies', function(Blueprint $table)
		{
			$table->dropColumn('version');
		});

		Schema::table('questiongroups', function(Blueprint $table)
		{
			$table->dropColumn('version');
		});

		Schema::table('rules', function(Blueprint $table)
		{
			$table->dropColumn('version');
		});

		Schema::table('questions', function(Blueprint $table)
		{
			$table->dropColumn('version');
		});
	}
}
