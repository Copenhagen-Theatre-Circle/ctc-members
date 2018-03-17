<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFunctiongroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('functiongroups', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('questionnaire_name')->nullable();
			$table->integer('sort_order')->nullable();
			$table->timestamps();
			$table->string('color_hex', 7)->nullable();
			$table->string('questionnaire_description')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('functiongroups');
	}

}
