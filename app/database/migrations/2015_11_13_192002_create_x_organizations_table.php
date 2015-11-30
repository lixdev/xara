<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateXOrganizationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('organizations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->default('XARA CBS')->nullable();
			$table->string('logo')->nullable();
			$table->string('email')->nullable();
			$table->string('website')->nullable();
			$table->string('address')->nullable();
			$table->string('phone')->nullable();
			$table->timestamps();
			$table->string('license_type', 20)->nullable()->default('evaluation');
			$table->string('license_code')->nullable();
			$table->string('license_key')->nullable();
			$table->bigInteger('licensed')->nullable()->default(100);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('organizations');
	}

}
