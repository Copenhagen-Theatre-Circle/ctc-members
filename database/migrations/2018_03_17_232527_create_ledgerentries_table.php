<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLedgerentriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ledgerentries', function(Blueprint $table)
		{
			$table->integer('__kp_id')->primary();
			$table->integer('_kf_Account')->nullable();
			$table->float('Amount', 10, 0)->nullable();
			$table->date('Date')->nullable();
			$table->text('Description', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ledgerentries');
	}

}
