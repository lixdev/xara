<?php

class NextOfKinsController extends \BaseController {

	/**
	 * Display a listing of kins
	 *
	 * @return Response
	 */
	public function index()
	{
		$kins = Nextofkin::all();

		return View::make('nextofkins.index', compact('kins'));
	}

	/**
	 * Show the form for creating a new kin
	 *
	 * @return Response
	 */
	public function create()
	{

		$employees = Employee::all();
		return View::make('nextofkins.create', compact('employees'));
	}

	/**
	 * Store a newly created kin in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Nextofkin::$rules,Nextofkin::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}


		$kin = new Nextofkin;

		$kin->employee_id=Input::get('employee_id');
		$kin->name = Input::get('name');
		$kin->relationship = Input::get('rship');
		$kin->goodwill = Input::get('goodwill');
		$kin->id_number = Input::get('id_number');
		$kin->save();

		Audit::logaudit('NextofKins', 'create', 'created: '.$kin->name);


		return Redirect::route('NextOfKins.index')->withFlashMessage('Employee`s next of kin successfully created!');
	}

	/**
	 * Display the specified kin.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$kin = Nextofkin::findOrFail($id);

		return View::make('nextofkins.show', compact('kin'));
	}

	/**
	 * Show the form for editing the specified kin.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$kin = Nextofkin::find($id);

		return View::make('nextofkins.edit', compact('kin'));
	}

	/**
	 * Update the specified kin in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$kin = Nextofkin::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Nextofkin::$rules,Nextofkin::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
        
		$kin->name = Input::get('name');
		$kin->relationship = Input::get('rship');
		$kin->goodwill = Input::get('goodwill');
		$kin->id_number = Input::get('id_number');


		$kin->update();

		return Redirect::route('NextOfKins.index')->withFlashMessage('Employee`s next of kin successfully updated!');
	}

	/**
	 * Remove the specified kin from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Nextofkin::destroy($id);

		return Redirect::route('NextOfKins.index')->withDeleteMessage('Employee`s next of kin successfully deleted!');
	}

}
