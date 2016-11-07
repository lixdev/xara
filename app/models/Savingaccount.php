<?php

class Savingaccount extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'account_number' => 'unique:account_number'
	];

	// Don't forget to fill this array
	protected $fillable = [];


	public function member(){

		return $this->belongsTo('Member');
	}


	public function savingproduct(){

		return $this->belongsTo('Savingproduct');
	}


	public function transactions(){

		return $this->hasMany('Savingtransaction');
	}



	public static function getLastAmount($savingaccount){

		$saving = DB::table('savingtransactions')->where('organization_id',Confide::user()->organization_id)->where('savingaccount_id', '=', $savingaccount->id)->where('type', '=', 'credit')->OrderBy('date',  'desc')->pluck('amount');

			
		if($saving){
			return $saving;
		}
		else {
			return 0;
		}
			

	}



	public static function getAccountBalance($savingaccount){

		$deposits = DB::table('savingtransactions')->where('organization_id',Confide::user()->organization_id)->where('savingaccount_id', '=', $savingaccount->id)->where('type', '=', 'credit')->sum('amount');
		$withdrawals = DB::table('savingtransactions')->where('organization_id',Confide::user()->organization_id)->where('savingaccount_id', '=', $savingaccount->id)->where('type', '=', 'debit')->sum('amount');

		$balance = $deposits - $withdrawals;

		return $balance;
	}




	public static function getDeductionAmount($account, $date){

       $part = explode("-", $date);
       $start_date = $part[1]."-".$part[0]."-01";
       $end_date  = date('Y-m-t', strtotime($start_date));
       $start  = date('Y-m-01', strtotime($end_date));

		$amount = DB::table('savingtransactions')->where('organization_id',Confide::user()->organization_id)->where('savingaccount_id', '=', $account->id)->where('type','credit')->whereBetween('date', array($start, $end_date))->sum('amount');

	
		 return $amount;
	}





	public static function getPeriodAmount($member){


		foreach($member->savingaccounts as $savingaccount){


			$saving = DB::table('savingtransactions')->where('organization_id',Confide::user()->organization_id)->where('savingaccount_id', '=', $savingaccount->id)->where('type', '=', 'credit')->OrderBy('date',  'desc')->pluck('amount');

			
		if($saving){
			return $saving;
		}
		else {
			return 0;
		}


		}

		
			

	}



	



}