<?php

class EarningsController extends \BaseController {

	/**
	 * Display a listing of branches
	 *
	 * @return Response
	 */
	public function index()
	{
		$earnings = DB::table('employee')
		          ->join('earnings', 'employee.id', '=', 'earnings.employee_id')
		          ->where('in_employment','=','Y')
		          ->get();

		Audit::logaudit('Earnings', 'view', 'viewed earnings');


		return View::make('other_earnings.index', compact('earnings'));
	}

	/**
	 * Show the form for creating a new branch
	 *
	 * @return Response
	 */
	public function create()
	{
		$employees = DB::table('employee')
		          ->where('in_employment','=','Y')
		          ->get();
		return View::make('other_earnings.create',compact('employees'));
	}

	/**
	 * Store a newly created branch in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Earnings::$rules, Earnings::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$earning = new Earnings;

		$earning->employee_id = Input::get('employee');

		$earning->earnings_name = Input::get('earning');

		$earning->narrative = Input::get('narrative');

		$a = str_replace( ',', '', Input::get('amount') );

        $earning->earnings_amount = $a;

		$earning->save();

		Audit::logaudit('Earnings', 'create', 'created: '.$earning->earnings_name.' for '.Employee::getEmployeeName(Input::get('employee')));


		return Redirect::route('other_earnings.index')->withFlashMessage('Earning successfully created!');
	}

	/**
	 * Display the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$earning = Earnings::findOrFail($id);

		return View::make('other_earnings.show', compact('earning'));
	}

	/**
	 * Show the form for editing the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$earning = DB::table('employee')
		          ->join('earnings', 'employee.id', '=', 'earnings.employee_id')
		          ->where('in_employment','=','Y')
		          ->first();

		return View::make('other_earnings.edit', compact('earning','employees'));
	}

	/**
	 * Update the specified branch in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$earning = Earnings::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Earnings::$rules, Earnings::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$earning->earnings_name = Input::get('earning');

		$earning->narrative = Input::get('narrative');

        $a = str_replace( ',', '', Input::get('amount') );

        $earning->earnings_amount = $a;

		$earning->update();

		Audit::logaudit('Earnings', 'update', 'updated: '.$earning->earnings_name.' for '.Employee::getEmployeeName($earning->employee_id));

		return Redirect::route('other_earnings.index')->withFlashMessage('Earning successfully updated!');
	}

	/**
	 * Remove the specified branch from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$earning = Earnings::findOrFail($id);
		Earnings::destroy($id);

		Audit::logaudit('Earnings', 'delete', 'deleted: '.$earning->earnings_name.' for '.Employee::getEmployeeName($earning->employee_id));

		return Redirect::route('other_earnings.index')->withDeleteMessage('Earning successfully deleted!');
	}

    public function view($id){

		$earning = Earnings::find($id);

		$organization = Organization::find(1);

		return View::make('other_earnings.view', compact('earning'));
		
	}

}
