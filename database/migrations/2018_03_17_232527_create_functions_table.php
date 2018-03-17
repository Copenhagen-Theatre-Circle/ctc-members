<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFunctionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('functions', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('functiongroup_id')->nullable();
			$table->string('programme_name', 100)->nullable();
			$table->string('questionnaire_name', 100)->nullable();
			$table->text('questionnaire_description', 65535)->nullable();
			$table->text('prospectus_description', 65535)->nullable();
			$table->integer('sort_order')->nullable();
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
		Schema::drop('functions');
	}

}
