<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMembershippricesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('membershipprices', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('membershiptype_id')->nullable();
			$table->integer('season_id')->nullable();
			$table->decimal('price', 10, 0)->nullable();
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
		Schema::drop('membershipprices');
	}

}
