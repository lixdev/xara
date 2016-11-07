<?php

class SavingaccountsController extends \BaseController {

	/**
	 * Display a listing of savingaccounts
	 *
	 * @return Response
	 */
	public function index()
	{
		$savingaccounts = Savingaccount::where('organization_id',Confide::user()->organization_id)->get();

		return View::make('savingaccounts.index', compact('savingaccounts'));
	}

	/**
	 * Show the form for creating a new savingaccount
	 *
	 * @return Response
	 */
	public function create($id)
	{

		$member = Member::findOrFail($id);
		$savingproducts = Savingproduct::where('organization_id',Confide::user()->organization_id)->get();
		return View::make('savingaccounts.create', compact('member', 'savingproducts'));
	}

	/**
	 * Store a newly created savingaccount in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Savingaccount::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}


		$member = Member::findOrFail(Input::get('member_id'));
		$savingproduct = Savingproduct::findOrFail(Input::get('savingproduct_id'));

		$acc_no = $savingproduct->shortname.'000000'.$member->membership_no;

		$savingaccount = new Savingaccount;
		$savingaccount->member()->associate($member);
		$savingaccount->savingproduct()->associate($savingproduct);
		$savingaccount->account_number = $acc_no;
		$savingaccount->organization_id = Confide::user()->organization_id;
		$savingaccount->save();

		return Redirect::to('/member/savingaccounts/'.Input::get('member_id'));
	}

	/**
	 * Display the specified savingaccount.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$savingaccount = Savingaccount::findOrFail($id);

		return View::make('savingaccounts.show', compact('savingaccount'));
	}

	/**
	 * Show the form for editing the specified savingaccount.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$savingaccount = Savingaccount::find($id);

		return View::make('savingaccounts.edit', compact('savingaccount'));
	}

	/**
	 * Update the specified savingaccount in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$savingaccount = Savingaccount::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Savingaccount::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$savingaccount->update($data);

		return Redirect::route('savingaccounts.index');
	}

	/**
	 * Remove the specified savingaccount from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Savingaccount::destroy($id);

		return Redirect::route('savingaccounts.index');
	}



	public function memberaccounts($id){


		$member = Member::findOrFail($id);



		return View::make('savingaccounts.memberaccounts', compact('member'));
	}

}
