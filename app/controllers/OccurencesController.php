<?php

class OccurencesController extends \BaseController {

	/**
	 * Display a listing of branches
	 *
	 * @return Response
	 */
	public function index()
	{
		$occurences = DB::table('employee')
		          ->join('occurences', 'employee.id', '=', 'occurences.employee_id')
		          ->where('in_employment','=','Y')
		          ->get();
        Audit::logaudit('Occurences', 'view', 'viewed occurences');

		return View::make('occurences.index', compact('occurences'));
	}

	/**
	 * Show the form for creating a new branch
	 *
	 * @return Response
	 */
	public function create($id)
	{
		$id=$id;
		$employees = DB::table('employee')
		          ->where('in_employment','=','Y')
		          ->get();
		return View::make('occurences.create',compact('employees','id'));
	}

	/**
	 * Store a newly created branch in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Occurence::$rules, Occurence::$messsages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$occurence = new Occurence;

		$occurence->occurence_brief = Input::get('brief');

		$occurence->employee_id = Input::get('employee');

		$occurence->occurence_type = Input::get('type');

		$occurence->narrative = Input::get('narrative');

		$occurence->occurence_date = Input::get('date');

        $occurence->organization_id = '1';

		$occurence->save();

		Audit::logaudit('Occurences', 'create', 'created: '.$occurence->occurence_brief.' for '.Employee::getEmployeeName(Input::get('employee')));


		return Redirect::to('occurences/view/'.$occurence->id)->withFlashMessage('Occurence successfully created!');
	}

	/**
	 * Display the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$occurence = Occurence::findOrFail($id);

		return View::make('occurences.show', compact('occurence'));
	}

	/**
	 * Show the form for editing the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$occurence = Occurence::find($id);

		$employees = Employee::all();

		return View::make('occurences.edit', compact('occurence','employees'));
	}

	/**
	 * Update the specified branch in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$occurence = Occurence::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Occurence::$rules, Occurence::$messsages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$occurence->occurence_brief = Input::get('brief');

		$occurence->occurence_type = Input::get('type');

		$occurence->narrative = Input::get('narrative');

		$occurence->occurence_date = Input::get('date');

		$occurence->update();

		Audit::logaudit('Occurences', 'update', 'updated: '.$occurence->occurence_brief.' for '.Employee::getEmployeeName(Input::get('employee')));

		return Redirect::to('occurences/view/'.$id)->withFlashMessage('Occurence successfully updated!');
	}

	/**
	 * Remove the specified branch from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$occurence = Occurence::findOrFail($id);
		Occurence::destroy($id);

		Audit::logaudit('Occurences', 'delete', 'deleted: '.$occurence->occurence_brief.' for '.Employee::getEmployeeName($occurence->employee_id));

		return Redirect::to('employees/view/'.$occurence->employee_id)->withDeleteMessage('Occurence successfully deleted!');
	}

    public function view($id){

		$occurence = Occurence::find($id);

		$organization = Organization::find(1);

		return View::make('occurences.view', compact('occurence'));
		
	}

}
