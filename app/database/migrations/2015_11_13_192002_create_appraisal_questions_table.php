<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAppraisalQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('appraisalquestions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('question');
			$table->string('category');
			$table->integer('rate')->nullable()->default('10');
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
		Schema::drop('appraisalquestions');
	}

}
