<?php

class LoanaccountsController extends \BaseController {

	/**
	 * Display a listing of loanaccounts
	 *
	 * @return Response
	 */
	public function index()
	{
		$loanaccounts = Loanaccount::where('organization_id',Confide::user()->organization_id)->get();

		return View::make('loanaccounts.index', compact('loanaccounts'));
	}

    public function guarantor()
	{

		 $member = Member::where('email',Confide::user()->email)->first();
		//$loanaccounts = Loanaccount::where('member_id',$member->id)->get();
        $loanaccounts = DB::table('loanaccounts')
		               ->join('loanguarantors', 'loanaccounts.id', '=', 'loanguarantors.loanaccount_id')
		               ->join('loanproducts', 'loanaccounts.loanproduct_id', '=', 'loanproducts.id')
		               ->join('members', 'loanaccounts.member_id', '=', 'members.id')
		               ->where('loanguarantors.member_id',$member->id)
		               ->where('loanguarantors.is_approved','pending')
		               ->select('loanaccounts.id','members.name as mname','loanproducts.name as pname','application_date','amount_applied','repayment_duration','loanaccounts.interest_rate')
		               ->get();
		return View::make('css.loanindex', compact('loanaccounts'));
	}

	public function guarantorapprove($id)
	{
		//$loanaccount =  new Loanaccount;

		$validator = Validator::make($data = Input::all(), loanguarantor::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		//$loanaccount->approve($data);

		$member = Member::where('membership_no',Confide::user()->username)->first();

		$loanguarantor = loanguarantor::where('loanaccount_id',$id)->where('member_id',$member->id)->first();
		$lg = loanguarantor::findOrFail($loanguarantor->id);
        $lg->is_approved = 'approved';
        $lg->date = date('Y-m-d');
		$lg->update();

        $mem = Member::find(array_get($data,'mid1'));

        $email = $mem->email;
        $name  = $mem->name;
        $pname = Input::get('pname');
        $amount = array_get($data, 'amount_applied');
    
        if($email != null){


        if(Mailsender::checkConnection() == false){

        return Redirect::back()->withDeleteMessage('Could not establish interenet connection. kindly check your mail settings');
        }

        Mail::queue( 'emails.guarantor', array('guarantor'=>$member->name, 'pname'=>$pname, 'name'=>$name, 'amount_applied'=>$amount), function( $message ) use ($mem)
        {
         $message->to($mem->email )->subject( 'Loan Guarantor Approval' );
        });
        
        

		return Redirect::to('/guarantorapproval')->withFlashMessage('You have successfully approved member loan!');
	    }


        }
	/**
	 * Show the form for creating a new loanaccount
	 *
	 * @return Response
	 */
	public function apply($id)
	{

		$member = Member::find($id);
		$loanproducts = Loanproduct::where('organization_id',Confide::user()->organization_id)->get();
		return View::make('loanaccounts.create', compact('member', 'loanproducts'));
	}



	public function apply2($id)
	{

		$member = Member::find($id);
        $guarantors = Member::where('id','!=',$id)->where('organization_id',Confide::user()->organization_id)->get();		
		$disbursed=Disbursementoption::where('organization_id',Confide::user()->organization_id)->get();
		$loanproducts = Loanproduct::where('organization_id',Confide::user()->organization_id)->get();
		return View::make('css.loancreate', compact('member', 'guarantors', 'loanproducts','disbursed'));					
	}

	/**
	 * Store a newly created loanaccount in storage.
	 *
	 * @return Response
	 */
	public function doapply()
	{
		$validator = Validator::make($data = Input::all(), Loanaccount::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Loanaccount::submitApplication($data);

		$id = array_get($data, 'member_id');

		return Redirect::to('loans');



	}



	public function doapply2()
	{
		$validator = Validator::make($data = Input::all(), Loanaccount::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Loanaccount::submitApplication($data);

		$id = array_get($data, 'member_id');

		return Redirect::to('memberloans');



	}


public function shopapplication()
	{

		$data =Input::all();


		

		
		


		Loanaccount::submitShopApplication($data);
		


		//$id = array_get($data, 'member_id');

		return Redirect::to('memberloans');

	

	}

	/**
	 * Display the specified loanaccount.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$loanaccount = Loanaccount::findOrFail($id);
		$interest = Loanaccount::getInterestAmount($loanaccount);
		$loanbalance = Loantransaction::getLoanBalance($loanaccount);
		$principal_paid = Loanrepayment::getPrincipalPaid($loanaccount);
		$interest_paid = Loanrepayment::getInterestPaid($loanaccount);
		$loanguarantors = $loanaccount->guarantors;

		$loantransactions = DB::table('loantransactions')->where('loanaccount_id', '=', $id)->orderBy('date', 'ASC')->get();
		
		return View::make('loanaccounts.show', compact('loanaccount', 'loanguarantors', 'interest', 'principal_paid', 'interest_paid', 'loanbalance', 'loantransactions'));
	}




	public function show2($id)
	{
		$loanaccount = Loanaccount::findOrFail($id);
		$interest = Loanaccount::getInterestAmount($loanaccount);
		$loanbalance = Loantransaction::getLoanBalance($loanaccount);
		$principal_paid = Loanrepayment::getPrincipalPaid($loanaccount);
		$interest_paid = Loanrepayment::getInterestPaid($loanaccount);
		$loanguarantors = $loanaccount->guarantors;
		
		return View::make('css.loanshow', compact('loanaccount', 'loanguarantors', 'interest', 'principal_paid', 'interest_paid', 'loanbalance'));
	}

	/**
	 * Show the form for editing the specified loanaccount.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$loanaccount = Loanaccount::find($id);

		return View::make('loanaccounts.edit', compact('loanaccount'));
	}

	/**
	 * Update the specified loanaccount in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$loanaccount = Loanaccount::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Loanaccount::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$loanaccount->update($data);

		return Redirect::route('loanaccounts.index');
	}

	/**
	 * Remove the specified loanaccount from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Loanaccount::destroy($id);

		return Redirect::route('loanaccounts.index');
	}




	public function approve($id)
	{
		$loanaccount = Loanaccount::find($id);

		return View::make('loanaccounts.approve', compact('loanaccount'));
	}

	/**
	 * Update the specified loanaccount in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function doapprove($id)
	{
		//$loanaccount =  new Loanaccount;

		$validator = Validator::make($data = Input::all(), Loanaccount::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		//$loanaccount->approve($data);


		$loanaccount_id = array_get($data, 'loanaccount_id');

		

		$loanaccount = Loanaccount::findorfail($loanaccount_id);


		


		$loanaccount->date_approved = array_get($data, 'date_approved');
		$loanaccount->amount_approved = array_get($data, 'amount_approved');
		$loanaccount->interest_rate = array_get($data, 'interest_rate');
		$loanaccount->period = array_get($data, 'period');
		$loanaccount->is_approved = TRUE;
		$loanaccount->is_new_application = FALSE;
		$loanaccount->update();

		return Redirect::route('loans.index');
	}



	public function reject($id)
	{
		$loanaccount = Loanaccount::find($id);

		return View::make('loanaccounts.reject', compact('loanaccount'));
	}


	public function rejectapplication()
	{
		
		$validator = Validator::make($data = Input::all(), Loanaccount::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

	

		$loanaccount_id = array_get($data, 'loanaccount_id');

		

		$loanaccount = Loanaccount::findorfail($loanaccount_id);

		$loanaccount->rejection_reason = array_get($data, 'reasons');
		$loanaccount->is_rejected = TRUE;
		$loanaccount->is_approved = FALSE;
		$loanaccount->is_new_application = FALSE;
		$loanaccount->update();

		return Redirect::route('loans.index');
	}





	public function disburse($id)
	{
		$loanaccount = Loanaccount::find($id);

		return View::make('loanaccounts.disburse', compact('loanaccount'));
	}

	/**
	 * Update the specified loanaccount in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function dodisburse($id)
	{
		//$loanaccount =  new Loanaccount;

		$validator = Validator::make($data = Input::all(), Loanaccount::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		//$loanaccount->approve($data);


		$loanaccount_id = array_get($data, 'loanaccount_id');

		

		$loanaccount = Loanaccount::findorfail($loanaccount_id);


		$amount = array_get($data, 'amount_disbursed');
		$date = array_get($data, 'date_disbursed');

		$loanaccount->date_disbursed = $date;
		$loanaccount->amount_disbursed = $amount;
		$loanaccount->repayment_start_date = array_get($data, 'repayment_start_date');
		$loanaccount->account_number = Loanaccount::loanAccountNumber($loanaccount);
		$loanaccount->is_disbursed = TRUE;
		
	
		$loanaccount->update();

		$loanamount = $amount + Loanaccount::getInterestAmount($loanaccount);
		Loantransaction::disburseLoan($loanaccount, $loanamount, $date);

		return Redirect::route('loans.index');
	}



	public function gettopup($id){

		$loanaccount = Loanaccount::findOrFail($id);


		return View::make('loanaccounts.topup', compact('loanaccount'));
	}



	public function topup($id){

		
		$data = Input::all();
		
		$date =  Input::get('top_up_date');
		$amount = Input::get('amount');

	
		$loanaccount = Loanaccount::findOrFail($id);



		$loanaccount->is_top_up = true;
		$loanaccount->top_up_amount = $amount;
		//$loanaccount->top_up_date = $date;
		$loanaccount->update();

		Loantransaction::topupLoan($loanaccount, $amount, $date);


		 return Redirect::to('loans/show/'.$loanaccount->id);

		

		
	}


}
