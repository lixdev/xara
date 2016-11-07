<?php

class Loanaccount extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'loanproduct_id' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];



	public function loanproduct(){

		return $this->belongsTo('Loanproduct');
	}


	public function member(){

		return $this->belongsTo('Member');
	}


	public function loanrepayments(){

		return $this->hasMany('Loanaccount');
	}


	public function loantransactions(){

		return $this->hasMany('Loantransaction');
	}

	public function guarantors(){

		return $this->hasMany('Loanguarantor');
	}



	public static function submitApplication($data){

		$member_id = array_get($data, 'member_id');
		$loanproduct_id = array_get($data, 'loanproduct_id');

		$member = Member::findorfail($member_id);

		$loanproduct = Loanproduct::findorfail($loanproduct_id);


		$application = new Loanaccount;


		$application->member()->associate($member);
		$application->loanproduct()->associate($loanproduct);
		$application->application_date = array_get($data, 'application_date');
		$application->amount_applied = array_get($data, 'amount_applied');
		$application->interest_rate = $loanproduct->interest_rate;
		$application->period = $loanproduct->period;
		$application->repayment_duration = array_get($data, 'repayment_duration');
		$application->organization_id = Confide::user()->organization_id;
		$application->save();

		Audit::logAudit(date('Y-m-d'), Confide::user()->username, 'loan application', 'Loans', array_get($data, 'amount_applied'));

	}




	public static function submitShopApplication($data){


		

		

		$mem = array_get($data, 'member');



		

		$member_id = DB::table('members')->where('membership_no', '=', $mem)->pluck('id');


		$loanproduct_id = array_get($data, 'loanproduct');


		$member = Member::findorfail($member_id);

		$product = Product::findorfail(array_get($data, 'product'));

		$loanproduct = Loanproduct::findorfail($loanproduct_id);


		$application = new Loanaccount;


		$application->member()->associate($member);
		$application->loanproduct()->associate($loanproduct);
		$application->application_date = date('Y-m-d');

		$application->amount_applied = array_get($data, 'amount');



		
		$application->interest_rate = $loanproduct->interest_rate;
		$application->period = array_get($data, 'repayment');

		$application->organization_id = Confide::user()->organization_id;
		
		$application->repayment_duration = array_get($data, 'repayment');
		$application->loan_purpose = array_get($data, 'purpose');
		$application->save();


		Order::submitOrder($product, $member);

		
		

	}



	public static function loanAccountNumber($loanaccount){

		
		$member = Member::find($loanaccount->member->id);

		$count = count($member->loanaccounts);
		$count = $count + 1;

		//$count = DB::table('loanproducts')->where('member_id', '=', $loanaccount->member->id)->count();

		$loanno = $loanaccount->loanproduct->short_name."-".$loanaccount->member->membership_no."-".$count;

		return $loanno;

	}



	public static function intBalOffset($loanaccount){


		$principal = Loanaccount::getPrincipalBal($loanaccount);

		$rate = $loanaccount->interest_rate/100;

		$time = $loanaccount->repayment_duration;

		$formula = $loanaccount->loanproduct->formula;

		if($formula == 'SL'){

			$interest_amount = $principal * $rate;

		}


		if($formula == 'RB'){

			
    		
    		
   			$principal_bal = $principal;
    		
    		$interest_amount = $principal_bal * $rate;

          
		}


		return $interest_amount;


	}


	public static function getEMPTacsix($loanaccount){

		 
		$principal = $loanaccount->amount_disbursed;
		$rate = $loanaccount->interest_rate/100;
		$time = $loanaccount->repayment_duration;

		$interest = $principal * $rate * $time;
		$amount = $principal + $interest;

		$amt = $amount/$time;

		return $amt;

	}



	public static function getInterestAmount($loanaccount){


		$principal = Loanaccount::getPrincipalBal($loanaccount);

		$rate = $loanaccount->interest_rate/100;

		$time = $loanaccount->repayment_duration;

		$formula = DB::table('loanproducts')->where('organization_id',Confide::user()->organization_id)->where('id', '=', $loanaccount->loanproduct_id)->pluck('formula');

		if($formula == 'SL'){

			$interest_amount = $principal * $rate * $time;

		}


		if($formula == 'RB'){

			
    		
    		
   			$principal_bal = $principal;
    		$interest_amount = 0;
    		$principal_pay = $principal/$time;

    		for($i=1; $i<=$time; $i++){


        		$interest_amount = ($interest_amount + ($principal_bal * $rate));

        		$principal_bal = $principal_bal - $principal_pay;

        		
    		}

          
		}


		return $interest_amount;
	}


	public static function hasAccount($member, $loanproduct){

		foreach ($member->loanaccounts as $loanaccount) {
			
			if($loanaccount->loanproduct->name == $loanproduct->name){

				return true;
			}
			else {
				return false;
			}
		}
	}


	public static function getTotalDue($loanaccount){

		$balance = Loantransaction::getLoanBalance($loanaccount);

		if($balance > 1 ){

			$principal = Loantransaction::getPrincipalDue($loanaccount);
			$interest = Loantransaction::getInterestDue($loanaccount);

			$total = $principal + $interest;

			return $total;
		}else {

			return 0;
		}

		
	}


	public static function getDurationAmount($loanaccount){

		$interest = Loanaccount::getInterestAmount($loanaccount);
		$principal = $loanaccount->amount_disbursed;

		$total =$principal + $interest;

		if($loanaccount->repayment_duration != null){

			$amount = $total/$loanaccount->repayment_duration;
		} else {

			$amount = $total/$loanaccount->period;

		}

		return $amount;

		
	}


	public static function getLoanAmount($loanaccount){

		$interest_amount = Loanaccount::getInterestAmount($loanaccount);
		$principal = $loanaccount->amount_disbursed;
		$topup = $loanaccount->top_up_amount;

		$amount = $principal + $interest_amount + $topup;

		return $amount;
	}


	public static function getEMP($loanaccount){

		$loanamount = Loanaccount::getLoanAmount($loanaccount);

		if($loanaccount->repayment_duration > 0){
			$period = $loanaccount->repayment_duration;
		}
		else {

			$period = $loanaccount->period;
		}

		if($loanaccount->loanproduct->amortization == 'EP'){

			if($loanaccount->loanproduct->formula == 'RB'){

				$principal = $loanaccount->amount_disbursed + $loanaccount->top_up_amount;

				$principal = $principal/$period;

				$interest = (Loantransaction::getLoanBalance($loanaccount) * ($loanaccount->loanproduct->rate/100));

				$mp = $principal + $interest;

			}

			if($loanaccount->loanproduct->formula == 'SL'){
				 $mp = $loanamount/$period;
			}
				
	
		}

		if($loanaccount->loanproduct->amortization == 'EI'){

			$mp = $loanamount / $loanaccount->repayment_duration;
			
		}

		

		return $mp;
	}



	public static function getInterestBal($loanaccount){

		$interest_amount = Loanaccount::getInterestAmount($loanaccount);

		$interest_paid = Loanrepayment::getInterestPaid($loanaccount);

		$interest_bal = $interest_amount - $interest_paid;

		return $interest_bal;
	}



	public static function getPrincipalBal($loanaccount){

		$principal_amount = $loanaccount->amount_disbursed + $loanaccount->top_up_amount;

		$principal_paid = Loanrepayment::getPrincipalPaid($loanaccount);

		$principal_bal = $principal_amount - $principal_paid;

		return $principal_bal;
	}


	public static function getDeductionAmount($loanaccount, $date){

       $part = explode("-", $date);
       $start_date = $part[1]."-".$part[0]."-01";
       $end_date  = date('Y-m-t', strtotime($start_date));
       $start  = date('Y-m-01', strtotime($end_date));

	   $amount = DB::table('loantransactions')->where('organization_id',Confide::user()->organization_id)->where('loanaccount_id', '=', $loanaccount->id)->where('type','credit')->whereBetween('date', array($start, $end_date))->sum('amount');

		return $amount;
	}
	
}