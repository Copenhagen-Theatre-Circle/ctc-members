<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionnaireAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questionnaire_answers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('person_id')->nullable();
			$table->integer('function_id')->nullable();
			$table->integer('functiongroup_id')->nullable();
			$table->integer('interest')->nullable();
			$table->integer('has_experience')->nullable();
			$table->integer('wants_to_learn')->nullable();
			$table->timestamps();
			$table->integer('experience_ctc')->nullable();
			$table->integer('experience_other')->nullable();
			$table->text('experience_other_description', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('questionnaire_answers');
	}

}
