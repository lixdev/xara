<?php

class Savingtransaction extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];


	public function savingaccount(){

		return $this->belongsTo('Savingaccount');
	}


	public static function getWithdrawalCharge($savingaccount){
		$chargeamount = 0;

		foreach ($savingaccount->savingproduct->charges as $charge) {

			if($charge->payment_method == 'withdrawal'){

				$chargeamount = $chargeamount + $charge->amount;

			}
			
		}

		return $chargeamount;
	}



	public static function withdrawalCharges($savingaccount, $date, $transAmount){

		foreach($savingaccount->savingproduct->charges as $charge){

			if($charge->payment_method == 'withdrawal'){


					if($charge->calculation_method == 'percent'){
						$amount = ($charge->amount/ 100) * $transAmount;
					}

					if($charge->calculation_method == 'flat'){
						$amount = $charge->amount;
					}



					$savingtransaction = new Savingtransaction;

					$savingtransaction->date = $date;
					$savingtransaction->savingaccount()->associate($savingaccount);
					$savingtransaction->amount = $amount;
					$savingtransaction->type = 'debit';
					$savingtransaction->description = 'withdrawal charge';
					$savingtransaction->organization_id = Confide::user()->organization_id;
					$savingtransaction->save();


				foreach($savingaccount->savingproduct->savingpostings as $posting){

					if($posting->transaction == 'charge'){

						$debit_account = $posting->debit_account;
						$credit_account = $posting->credit_account;

						$data = array(
						'credit_account' => $credit_account,
						'debit_account' => $debit_account,
						'organization_id',Confide::user()->organization_id,
						'date' => $date,
						'amount' => $amount,
						'initiated_by' => 'system',
						'description' => 'cash withdrawal'
					);


					$journal = new Journal;


					$journal->journal_entry($data);

					
					}

					


					

				
				}







			}
		}
	}



	public static function importSavings($member, $date, $savingaccount, $amount){

		
		
		
		$member = Member::find($member[0]->id);
		$savingaccount = Savingaccount::find($savingaccount[0]->id);
		


		
		//check if account and member exists



		$savingtransaction = new Savingtransaction;

		$savingtransaction->date = $date;
		$savingtransaction->savingaccount()->associate($savingaccount);
		$savingtransaction->amount = $amount;
		$savingtransaction->type = 'credit';
		$savingtransaction->description = 'savings deposit';
		$savingtransaction->transacted_by = $member->fullname;
		$savingtransaction->organization_id = Confide::user()->organization_id;
		$savingtransaction->save();


		foreach($savingaccount->savingproduct->savingpostings as $posting){

				if($posting->transaction == 'deposit'){

					$debit_account = $posting->debit_account;
					$credit_account = $posting->credit_account;
				}
			}



			$data = array(
				'credit_account' => $credit_account,
				'debit_account' => $debit_account,
				'date' => $date,
				'organization_id',Confide::user()->organization_id,
				'amount' => $amount,
				'initiated_by' => 'system',
				'description' => 'cash deposit'
				);


			$journal = new Journal;


			$journal->journal_entry($data);

			Audit::logAudit(date('Y-m-d'), Confide::user()->username, 'Savings imported', 'Savings', $amount);

			

	}



	public static function creditAccounts($data){





		$savingaccount = Savingaccount::findOrFail(array_get($data, 'account_id'));

		$savingtransaction = new Savingtransaction;

		$savingtransaction->date = array_get($data,'date');
		$savingtransaction->savingaccount()->associate($savingaccount);
		$savingtransaction->amount = array_get($data,'amount');
		$savingtransaction->type = array_get($data,'type');
		$savingtransaction->description = 'savings deposit';
		$savingtransaction->organization_id = Confide::user()->organization_id;
		$savingtransaction->save();


	
		

		


		// deposit
		if(array_get($data,'type') == 'credit'){


			foreach($savingaccount->savingproduct->savingpostings as $posting){

				if($posting->transaction == 'deposit'){

					$debit_account = $posting->debit_account;
					$credit_account = $posting->credit_account;
				}
			}



			$data = array(
				'credit_account' => $credit_account,
				'debit_account' => $debit_account,
				'date' => array_get($data, 'date'),
				'organization_id',Confide::user()->organization_id,
				'amount' => array_get($data,'amount'),
				'initiated_by' => 'system',
				'description' => 'cash deposit'
				);


			$journal = new Journal;


			$journal->journal_entry($data);

			Audit::logAudit(date('Y-m-d'), Confide::user()->username, 'savings deposit', 'Savings', array_get($data,'amount'));
			
		}

	}






	public static function transact($date, $savingaccount, $amount, $type, $description, $transacted_by){

		$savingtransaction = new Savingtransaction;

		$savingtransaction->date = $date;
		$savingtransaction->savingaccount()->associate($savingaccount);
		$savingtransaction->amount = $amount;
		$savingtransaction->type = $type;
		$savingtransaction->description = $description;
		$savingtransaction->transacted_by = $transacted_by;
		$savingtransaction->organization_id = Confide::user()->organization_id;
		$savingtransaction->save();


	
		// withdrawal 

		if($type == 'debit'){


			foreach($savingaccount->savingproduct->savingpostings as $posting){

				if($posting->transaction == 'withdrawal'){

					$debit_account = $posting->debit_account;
					$credit_account = $posting->credit_account;
				}

				
			}



			$data = array(
				'credit_account' => $credit_account,
				'debit_account' => $debit_account,
				'date' => $date,
				'organization_id',Confide::user()->organization_id,
				'amount' => $amount,
				'initiated_by' => 'system',
				'description' => $description
				);


			$journal = new Journal;


			$journal->journal_entry($data);


			Savingtransaction::withdrawalCharges($savingaccount, $date, $amount);

			Audit::logAudit(date('Y-m-d'), Confide::user()->username, $description, 'Savings', $amount);

		}


		// deposit
		if($type == 'credit'){


			foreach($savingaccount->savingproduct->savingpostings as $posting){

				if($posting->transaction == 'deposit'){

					$debit_account = $posting->debit_account;
					$credit_account = $posting->credit_account;
				}
			}



			$data = array(
				'credit_account' => $credit_account,
				'debit_account' => $debit_account,
				'date' => $date,
				'organization_id',Confide::user()->organization_id,
				'amount' => $amount,
				'initiated_by' => 'system',
				'description' => $description
				);


			$journal = new Journal;


			$journal->journal_entry($data);

			Audit::logAudit(date('Y-m-d'), Confide::user()->username, $description, 'Savings', $amount);
			
		}


	}




	



	public static function trasactionExists($date, $savingaccount){


		$dt = explode('-', $date);
		$mnth = $dt[1];

		$dates = DB::table('loantransactions')->where('organization_id',Confide::user()->organization_id)->where('loanaccount_id', '=', $savingaccount->id)->get();

		foreach ($dates as $date) {

			$dat = explode('-', $date->date);
			$month = $dat[1];
			
			if($mnth == $month){

				return true;
			} else {

				return false;
			}

		}

		
	}


  public static function getMember($id){

		$savingaccount = Savingaccount::find($id);

		$member = Member::find($savingaccount->member_id);

		return $member->name." - ".$member->membership_no;
	}



	public static function getsavingaccount($id){

		$savingaccount = Savingaccount::find($id);

		

		return $savingaccount->account_number;
	}




	
}