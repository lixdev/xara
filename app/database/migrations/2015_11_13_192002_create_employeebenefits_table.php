<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeeBenefitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employeebenefits', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('job_group_id')->unsigned()->index('employeebenefits_job_group_id_foreign');
			$table->integer('benefit_id')->unsigned()->index('employeebenefits_benefit_id_foreign');
			$table->string('amount')->default('0.00');
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
		Schema::drop('employeebenefits');
	}

}
