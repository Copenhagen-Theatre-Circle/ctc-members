<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePhotographsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('photographs', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('person_id')->nullable();
			$table->string('file_name')->nullable();
			$table->integer('is_portrait')->nullable();
			$table->integer('is_banner')->nullable();
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
		Schema::drop('photographs');
	}

}
