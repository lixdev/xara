<?php

class Account extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'code' => 'required',
		'name' => 'required',
		'category' => 'required',
	];

	// Don't forget to fill this array
	protected $fillable = [];


	public function journals(){

		return $this->hasMany('Journal');
	}


	public function savingProduct(){

		return $this->belongsTo('Saving');
	}



	// create savings accounts
	public function createsavingaccount($acc_name, $product){

		//create savings control

		$category = 'LIABILITY';

		$account = new Account;

		$account->category = 'LIABILITY';
		$account->code = getaccountcode($category);
		$account->name = $acc_name.' control';
		$account->active = TRUE;
		$account->savingproduct()->associate($product);
                $account->organization_id = Confide::user()->organization_id;
		$account->save();



		$category = 'INCOME';

		$account = new Account;

		$account->category = 'INCOME';
		$account->code = getaccountcode($category);
		$account->name = $acc_name.' fee income';
		$account->active = TRUE;
		$account->savingproduct()->associate($product);
                $account->organization_id = Confide::user()->organization_id;
		$account->save();
	}



	public function getaccountcode($category){
		$code = DB::table('accounts')->where('active',true)->where('organization_id',Confide::user()->organization_id)->where('category', '=', $category)->orderBy('code', 'ASC')->first();

		$code = $code + 1;

		return $code;
	}

	public static function getAccountBalanceAtDate($account, $date){

		$balance = 0;
		$credit = DB::table('journals')->where('void',0)->where('organization_id',Confide::user()->organization_id)->where('account_id', '=', $account->id)->where('type', '=', 'credit')->where('date', '<=', $date)->sum('amount');
		$debit = DB::table('journals')->where('void',0)->where('organization_id',Confide::user()->organization_id)->where('account_id', '=', $account->id)->where('type', '=', 'debit')->where('date', '<=', $date)->sum('amount');

		if($account->category == 'ASSET'){

			$balance = $debit - $credit;


		}

		if($account->category == 'INCOME'){

			$balance = $credit - $debit;
			

		}

		if($account->category == 'LIABILITY'){

			$balance = $credit - $debit;
			

		}

		if($account->category == 'EQUITY'){

			$balance = $credit - $debit;
			

		}

		if($account->category == 'EXPENSE'){

			$balance = $debit - $credit;


		}


		return $balance;


	}



	public static function balanceSheet($date){

		$accounts = Account::where('organization_id',Confide::user()->organization_id)->where('active',true)->get();

		$organization = Organization::find(Confide::user()->organization_id);

		$pdf = PDF::loadView('pdf.financials.balancesheet', compact('accounts', 'date', 'organization'))->setPaper('a4')->setOrientation('potrait');
 	
		return $pdf->stream('Balance Sheet.pdf');
	}

}