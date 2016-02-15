<?php

class OccurencesController extends \BaseController {

	/**
	 * Display a listing of branches
	 *
	 * @return Response
	 */
	public function index()
	{
		$occurences = Occurence::all();

		



		return View::make('occurences.index', compact('occurences'));
	}

	/**
	 * Show the form for creating a new branch
	 *
	 * @return Response
	 */
	public function create()
	{
		$employees = Employee::all();
		return View::make('occurences.create',compact('employees'));
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

		Audit::logaudit('Occurences', 'create', 'created: '.$occurence->occurence_brief);


		return Redirect::route('occurences.index');
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

		$occurence->employee_id = Input::get('employee');

		$occurence->occurence_type = Input::get('type');

		$occurence->narrative = Input::get('narrative');

		$occurence->occurence_date = Input::get('date');

		$occurence->update();

		Audit::logaudit('Occurences', 'update', 'updated: '.$occurence->occurence_brief);

		return Redirect::route('occurences.index');
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

		Audit::logaudit('Occurences', 'delete', 'deleted: '.$occurence->occurence_brief);

		return Redirect::route('occurences.index');
	}

}
