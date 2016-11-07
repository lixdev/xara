<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactAllowancesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transact_allowances', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('employee_id')->unsigned();
			$table->foreign('employee_id')->references('id')->on('employee')->onDelete('restrict')->onUpdate('cascade');
			$table->integer('employee_allowance_id')->unsigned();
			$table->integer('allowance_id')->unsigned()->default('0')->index('transact_allowances_allowance_id_foreign');
			$table->string('allowance_name');
			$table->string('allowance_amount')->default('0.00');
			$table->string('financial_month_year');
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
		Schema::drop('transact_allowances');
	}

}
