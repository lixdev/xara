<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFourColumnsToLoanAccounts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('loanaccounts',function($table){
			$table->enum('is_recovered',array(0,1))->default(0);	
			$table->enum('is_converted',array(0,1))->default(0);			
			$table->enum('guarantor_approved',array(0,1))->default(0);			
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
			$table->dropColumn('is_recovered');
			$table->dropColumn('is_converted');				
			$table->dropColumn('guarantor_approved');						
		});		
	}

}