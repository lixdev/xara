<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePropertiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('properties', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('employee_id')->unsigned()->index('properties_employee_id_foreign');
			$table->string('name');
			$table->text('description')->nullable();
			$table->string('serial')->nullable();
			$table->string('digitalserial')->nullable();
			$table->float('monetary',15,2)->default('0.00');
			$table->integer('issued_by')->unsigned()->index('properties_issued_by_foreign');
			$table->date('issue_date');
			$table->date('scheduled_return_date');
			$table->integer('state')->default('0');
			$table->integer('received_by')->nullable()->unsigned()->index('properties_returned_by_foreign');
			$table->date('return_date')->nullable();
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
		Schema::drop('properties');
	}

}
