<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateXOccurencesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('occurences', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('occurence_brief');
			$table->integer('employee_id')->unsigned()->default('0')->index('occurences_employee_id_foreign');;
			$table->string('occurence_type');
			$table->text('narrative')->nullable();
			$table->date('occurence_date');
			$table->integer('organization_id')->unsigned()->default('0')->index('occurences_organization_id_foreign');
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
		Schema::drop('occurences');
	}

}
