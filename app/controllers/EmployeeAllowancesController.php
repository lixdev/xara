<?php

class EmployeeAllowancesController extends \BaseController {

	/**
	 * Display a listing of branches
	 *
	 * @return Response
	 */
	public function index()
	{
		$eallws = DB::table('employee_allowances')
		          ->join('employee', 'employee_allowances.employee_id', '=', 'employee.id')
		          ->join('allowances', 'employee_allowances.allowance_id', '=', 'allowances.id')
		          ->where('in_employment','=','Y')
		          ->select('employee_allowances.id','first_name','last_name','allowance_amount','allowance_name')
		          ->get();

		Audit::logaudit('Employee Allowances', 'view', 'viewed employee allowances');

		return View::make('employee_allowances.index', compact('eallws'));
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
		$allowances = Allowance::all();
		return View::make('employee_allowances.create',compact('employees','allowances'));
	}

	/**
	 * Store a newly created branch in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), EAllowances::$rules, EAllowances::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$allowance = new EAllowances;

		$allowance->employee_id = Input::get('employee');

		$allowance->allowance_id = Input::get('allowance');

        $a = str_replace( ',', '', Input::get('amount') );

        $allowance->allowance_amount = $a;

		$allowance->save();

		

		Audit::logaudit('Employee Allowances', 'create', 'assigned: '.$allowance->allowance_amount.' to'.Employee::getEmployeeName(Input::get('employee')));

		return Redirect::route('employee_allowances.index')->withFlashMessage('Employee Allowance successfully created!');
	}

	/**
	 * Display the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$eallw = EAllowances::findOrFail($id);

		return View::make('employee_allowances.show', compact('eallw'));
	}

	/**
	 * Show the form for editing the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$eallw = EAllowances::find($id);
		$employees = Employee::all();
		$allowances = Allowance::all();

		return View::make('employee_allowances.edit', compact('eallw','allowances','employees'));
	}

	/**
	 * Update the specified branch in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$allowance = EAllowances::findOrFail($id);

		$validator = Validator::make($data = Input::all(), EAllowances::$rules, EAllowances::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}


		$allowance->allowance_id = Input::get('allowance');

        $a = str_replace( ',', '', Input::get('amount') );

        $allowance->allowance_amount = $a;

		$allowance->update();

		Audit::logaudit('Employee Allowances', 'update', 'assigned: '.$allowance->allowance_amount.' to '.Employee::getEmployeeName($allowance->employee_id));

		return Redirect::route('employee_allowances.index')->withFlashMessage('Employee Allowance successfully updated!');
	}

	/**
	 * Remove the specified branch from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$allowance = EAllowances::findOrFail($id);

		EAllowances::destroy($id);


		Audit::logaudit('Employee Allowances', 'delete', 'deleted: '.$allowance->allowance_amount.' for '.Employee::getEmployeeName($allowance->employee_id));


		return Redirect::route('employee_allowances.index')->withDeleteMessage('Employee Allowance successfully deleted!');
	}

    public function view($id){

		$eallw = DB::table('employee_allowances')
		          ->join('employee', 'employee_allowances.employee_id', '=', 'employee.id')
		          ->join('allowances', 'employee_allowances.allowance_id', '=', 'allowances.id')
		          ->where('employee_allowances.id','=',$id)
		          ->select('employee_allowances.id','first_name','last_name','middle_name','allowance_amount','allowance_name','photo','signature')
		          ->first();

		$organization = Organization::find(1);

		return View::make('employee_allowances.view', compact('eallw'));
		
	}


}
