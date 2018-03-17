<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuditionFormAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('audition_form_answers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('person_id')->nullable();
			$table->integer('project_id')->nullable();
			$table->text('not_available_weekdays', 65535)->nullable();
			$table->text('not_available_dates', 65535)->nullable();
			$table->string('heard_about')->nullable();
			$table->text('date_preferences', 65535)->nullable();
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
		Schema::drop('audition_form_answers');
	}

}
