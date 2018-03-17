<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->primary();
			$table->integer('season_id')->nullable();
			$table->integer('venue_id')->nullable();
			$table->date('date_start')->nullable();
			$table->date('date_end')->nullable();
			$table->string('name')->nullable();
			$table->string('name_shortform')->nullable();
			$table->integer('number_of_performances')->nullable();
			$table->text('synopsis', 65535)->nullable();
			$table->integer('publish_online_flag')->nullable();
			$table->char('uuid', 128)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('projects');
	}

}
