<?php

class OvertimesController extends \BaseController {

	/**
	 * Display a listing of branches
	 *
	 * @return Response
	 */
	public function index()
	{
		$overtimes = DB::table('employee')
		          ->join('overtimes', 'employee.id', '=', 'overtimes.employee_id')
		          ->where('in_employment','=','Y')
		          ->select('overtimes.id','type','first_name','last_name','rate','amount','period')
		          ->get();

		Audit::logaudit('Overtimes', 'view', 'viewed employee overtime');

		return View::make('overtime.index', compact('overtimes'));
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

		return View::make('overtime.create', compact('employees'));
	}

	/**
	 * Store a newly created branch in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Overtime::$rules, Overtime::$messsages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$overtime= new Overtime;
        
        $overtime->employee_id = Input::get('employee');

		$overtime->type = Input::get('type');

		$overtime->rate = Input::get('rate');

		$overtime->period = Input::get('period');

		$a = str_replace( ',', '', Input::get('amount') );

		$overtime->amount = $a;

		$overtime->save();

		Audit::logaudit('Overtimes', 'create', 'created: '.$overtime->type.' for '.Employee::getEmployeeName(Input::get('employee')));


		return Redirect::route('overtimes.index')->withFlashMessage('Employee Overtime successfully created!');
	}

	/**
	 * Display the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$overtime = Overtime::findOrFail($id);

		return View::make('overtime.show', compact('overtime'));
	}

	/**
	 * Show the form for editing the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$overtime = Overtime::find($id);

		return View::make('overtime.edit', compact('overtime'));
	}

	/**
	 * Update the specified branch in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$overtime = Overtime::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Overtime::$rules, Overtime::$messsages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$overtime->type = Input::get('type');

		$overtime->period = Input::get('period');

		$overtime->rate = Input::get('rate');
        $a = str_replace( ',', '', Input::get('amount') );

		$overtime->amount = $a;

		$overtime->update();

		Audit::logaudit('Overtimes', 'update', 'updated: '.$overtime->type.' for '.Employee::getEmployeeName($overtime->employee_id));

		return Redirect::route('overtimes.index')->withFlashMessage('Employee Overtime successfully updated!');
	}

	/**
	 * Remove the specified branch from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$overtime = Overtime::findOrFail($id);
		Overtime::destroy($id);

		Audit::logaudit('Overtimes', 'delete', 'deleted: '.$overtime->type.' for '.Employee::getEmployeeName($overtime->employee_id));

		return Redirect::route('overtimes.index')->withDeleteMessage('Employee Overtime successfully deleted!');
	}

	public function view($id){

		$overtime = Overtime::find($id);

		$organization = Organization::find(1);

		return View::make('overtime.view', compact('overtime'));
		
	}

}
