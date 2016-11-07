<?php

class AccountsController extends \BaseController {

	/**
	 * Display a listing of accounts
	 *
	 * @return Response
	 */
	public function index()
	{
		$accounts = DB::table('accounts')->where('organization_id',Confide::user()->organization_id)->orderBy('code', 'asc')->get();
                $organization = Organization::find(Confide::user()->organization_id);
		return View::make('accounts.index', compact('accounts','organization'));


		Audit::logaudit('Accounts', 'view', 'view chart of accounts');
	}

	/**
	 * Show the form for creating a new account
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('accounts.create');
	}

	/**
	 * Store a newly created account in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Account::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}


		// check if code exists
		$code = Input::get('code');
		$code_exists = DB::table('accounts')->where('organization_id',Confide::user()->organization_id)->where('code', '=', $code)->count();

		if($code_exists >= 1){

			return Redirect::back()->withErrors(array('error'=>'The GL code already exists'))->withInput();
		}
		else {


		$account = new Account;


		$account->category = Input::get('category');
		$account->name = Input::get('name');
		$account->code = Input::get('code');
		$account->balance = Input::get('balance');
		$account->organization_id = Confide::user()->organization_id;
		if(Input::get('active')){
			$account->active = TRUE;
		}
		else {
			$account->active = FALSE;
		}
		$account->save();

		}

		Audit::logaudit('Accounts', 'create', 'created: '.$account->name.' '.$account->code);

		return Redirect::route('accounts.index');
	}

	/**
	 * Display the specified account.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$account = Account::findOrFail($id);

		return View::make('accounts.show', compact('account'));
	}

	/**
	 * Show the form for editing the specified account.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$account = Account::find($id);



		return View::make('accounts.edit', compact('account'));
	}

	/**
	 * Update the specified account in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$account = Account::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Account::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$code = Input::get('code');
		$original_code = DB::table('accounts')->where('organization_id',Confide::user()->organization_id)->where('id', '=', $account->id)->pluck('code');

		if($code != $original_code) {

			$code_exists = DB::table('accounts')->where('organization_id',Confide::user()->organization_id)->where('code', '=', $code)->count();

		if($code_exists >= 1){

			return Redirect::back()->withErrors(array('error'=>'The GL code already exists'))->withInput();
		}


		else {


		

		$account->category = Input::get('category');
		$account->name = Input::get('name');
		$account->code = Input::get('code');
		$account->balance = Input::get('balance');
		if(Input::get('active')){
			$account->active = TRUE;
		}
		else {
			$account->active = FALSE;
		}
		
		$account->update();

		}

		} else {

		$account->category = Input::get('category');
		$account->name = Input::get('name');
		$account->code = Input::get('code');
		$account->balance = Input::get('balance');
		$account->active = Input::get('active');
		$account->update();

		}
		
		Audit::logaudit('Accounts', 'update', 'updated: '.$account->name.' '.$account->code);


		return Redirect::route('accounts.index');
	}

	/**
	 * Remove the specified account from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

		$account = Account::findOrFail($id);

		Account::destroy($id);


		Audit::logaudit('Accounts', 'delete', 'deleted:'.$account->name.' '.$account->code);


		return Redirect::route('accounts.index');
	}

}
