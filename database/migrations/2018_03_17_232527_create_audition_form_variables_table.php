<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuditionFormVariablesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('audition_form_variables', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('project_id');
			$table->string('banner_filename')->nullable();
			$table->string('banner_background_color')->nullable();
			$table->integer('banner_max_width_px')->nullable();
			$table->string('performance_dates')->nullable();
			$table->string('reply_to_address')->nullable();
			$table->text('availability_text_1', 65535)->nullable();
			$table->text('availability_text_2', 65535)->nullable();
			$table->text('concluding_text', 65535)->nullable();
			$table->text('date_preferences', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('audition_form_variables');
	}

}
