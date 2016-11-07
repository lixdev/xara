<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDsbursementIDtoLoanAccounts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('loanaccounts',function($table){
			$table->integer('disbursement_id');					
		});		
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('loanaccounts',function($table){
			$table->dropColumn('disbursement_id');			
		});		
	}

}
