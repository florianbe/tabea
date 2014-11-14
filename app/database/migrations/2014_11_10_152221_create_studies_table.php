<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('studystates', function(Blueprint $table) {
            $table->increments('id');
            $table->text('code');
            $table->text('name');
        });

        // Fill with predefined states
        $state_data = [
            ['code' => 'DESIGN', 'name' => 'in Erstellung'],
            ['code' => 'PLANNED', 'name' => 'Geplant'],
            ['code' => 'RUNNING', 'name' => 'Laufend'],
            ['code' => 'CLOSED', 'name' => 'Abgeschlossen'],
            ['code' => 'ARCHIVED', 'name' => 'Archiviert']
        ];

        DB::table('studystates')->insert($state_data);

        Schema::create('studies', function(Blueprint $table)
		{
			$table->increments('id');

            $table->text('name');
            $table->text('short_name', 20);
            $table->text('description');
            $table->text('comment');
            $table->text('password');

            $table->dateTime('accessible_from');
            $table->dateTime('accessible_until');
            $table->dateTime('answerable_from');
            $table->dateTime('answerable_until');
            $table->dateTime('uploadable_until');

            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')->references('id')->on('users');

            $table->integer('studystate_id')->unsigned();
            $table->foreign('studystate_id')->references('id')->on('studystates');

			$table->timestamps();
		});

        Schema::create('user_study', function(Blueprint $table)
        {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('study_id')->unsigned();
            $table->foreign('study_id')->references('id')->on('studies');

            $table->boolean('is_contributor');

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
        Schema::drop('user_study');
        Schema::drop('studies');
        Schema::drop('studystates');
	}

}
