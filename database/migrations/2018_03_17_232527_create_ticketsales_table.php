<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketsalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ticketsales', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('show_id')->nullable();
			$table->date('date')->nullable();
			$table->time('time')->nullable();
			$table->integer('sequence_id')->nullable();
			$table->string('ticket_type', 20)->nullable();
			$table->float('price', 10, 0)->nullable();
			$table->string('pr')->nullable();
			$table->string('newsletter', 4)->nullable();
			$table->string('first_name', 55)->nullable();
			$table->string('last_name', 55)->nullable();
			$table->string('mail', 55)->nullable();
			$table->string('address', 55)->nullable();
			$table->string('address_2', 55)->nullable();
			$table->string('post_code', 10)->nullable();
			$table->string('city', 55)->nullable();
			$table->string('country', 55)->nullable();
			$table->string('telephone', 55)->nullable();
			$table->string('order_type', 55)->nullable();
			$table->string('sold_by', 55)->nullable();
			$table->string('order_status', 55)->nullable();
			$table->string('order_number', 7)->nullable();
			$table->string('order_barcode', 25)->nullable();
			$table->string('card_number', 16)->nullable();
			$table->string('order_date_and_time', 55)->nullable();
			$table->string('cancelled_date_and_time', 55)->nullable();
			$table->string('scanned_date_and_time', 55)->nullable();
			$table->string('name_on_ticket', 55)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ticketsales');
	}

}
