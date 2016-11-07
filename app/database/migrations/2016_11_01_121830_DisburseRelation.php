<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DisburseRelation extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('disbursementoptions',function($table){
			$table->increments('id');
			$table->string('name');
			$table->decimal('min',15,2);
			$table->decimal('max',15,2);
			$table->string('description');
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
		Schema::drop('disbursementoptions');
	}

}
