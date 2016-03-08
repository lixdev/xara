<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAppraisalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('appraisals', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('employee_id')->unsigned()->index('appraisals_employee_id_foreign');
			$table->integer('appraisalquestion_id')->unsigned()->index('appraisals_appraisalquestion_id_foreign');
			$table->string('performance');
			$table->integer('rate')->default('0');
			$table->integer('examiner')->unsigned()->index('appraisals_examiner_foreign');
			$table->date('appraisaldate');
			$table->text('comment');
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
		Schema::drop('appraisals');
	}

}
