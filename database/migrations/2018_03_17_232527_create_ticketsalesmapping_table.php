<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketsalesmappingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ticketsalesmapping', function(Blueprint $table)
		{
			$table->integer('__kp_id', true);
			$table->string('csv_field', 55)->nullable();
			$table->string('mysql_field', 55)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ticketsalesmapping');
	}

}
