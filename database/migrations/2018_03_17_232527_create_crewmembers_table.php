<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCrewmembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crewmembers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('person_id');
			$table->integer('crewfunction_id');
			$table->integer('projectplay_id');
			$table->integer('project_id');
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
		Schema::drop('crewmembers');
	}

}
