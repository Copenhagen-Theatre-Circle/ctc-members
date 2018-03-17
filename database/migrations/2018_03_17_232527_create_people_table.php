<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePeopleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('people', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('uniqid')->nullable();
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('salutation')->nullable();
			$table->string('street_1')->nullable();
			$table->string('street_2')->nullable();
			$table->string('post_code')->nullable();
			$table->string('city')->nullable();
			$table->integer('country_id')->nullable();
			$table->string('mail')->nullable();
			$table->string('mobile')->nullable();
			$table->string('home_phone')->nullable();
			$table->string('office_phone')->nullable();
			$table->string('gender')->nullable();
			$table->text('member_bio', 65535)->nullable();
			$table->text('public_bio', 65535)->nullable();
			$table->integer('is_life_member')->nullable();
			$table->integer('can_see_all_people')->nullable();
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
		Schema::drop('people');
	}

}
