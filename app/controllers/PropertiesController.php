<?php

class PropertiesController extends \BaseController {

	/**
	 * Display a listing of kins
	 *
	 * @return Response
	 */
	public function index()
	{
		$properties = Property::all();

		return View::make('properties.index', compact('properties'));
	}

	/**
	 * Show the form for creating a new kin
	 *
	 * @return Response
	 */
	public function create()
	{

		$employees = Employee::all();
		return View::make('properties.create', compact('employees'));
	}

	/**
	 * Store a newly created kin in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Property::$rules,Property::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}


		$property = new Property;

		$property->employee_id=Input::get('employee_id');
		$property->name = Input::get('name');
		$property->description = Input::get('desc');
		$property->serial = Input::get('serial');
		$property->digitalserial = Input::get('dserial');
		$property->monetary = Input::get('amount');
		$property->issued_by = Confide::user()->id;
		$property->issue_date = Input::get('idate');
		$property->scheduled_return_date = Input::get('sdate');
		if(filter_var(Input::get('active'), FILTER_VALIDATE_BOOLEAN)){
        $property->state = 1;
        $property->received_by = Confide::user()->id;
        $property->return_date = Input::get('idate');
		}else{
        $property->state = 0;
        $property->received_by = 0;
        $property->return_date = null;
		}
		$property->save();

		Audit::logaudit('Properties', 'create', 'created: '.$property->name);


		return Redirect::route('Properties.index')->withFlashMessage('Company property successfully created!');
	}

	/**
	 * Display the specified kin.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$property = Property::findOrFail($id);

		return View::make('properties.show', compact('property'));
	}

	/**
	 * Show the form for editing the specified kin.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$property = Property::find($id);

		$user = User::findOrFail($property->issued_by);

		if($property->received_by>0){
        $retuser = User::findOrFail($property->received_by);
		}

		return View::make('properties.edit', compact('property','user','retuser'));
	}

	/**
	 * Update the specified kin in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$property = Property::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Property::$rules,Property::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
        
		$property->name = Input::get('name');
		$property->description = Input::get('desc');
		$property->serial = Input::get('serial');
		$property->digitalserial = Input::get('dserial');
		$property->monetary = Input::get('amount');
		$property->scheduled_return_date = Input::get('sdate');
		if(filter_var(Input::get('active'), FILTER_VALIDATE_BOOLEAN)){
        $property->state = 1;
        $property->received_by = Confide::user()->id;
        $property->return_date = date('Y-m-d');
		}else{
        $property->state = 0;
        $property->received_by = 0;
        $property->return_date = null;
		}

		$property->update();

		Audit::logaudit('Properties', 'update', 'updated: '.$property->name);

		return Redirect::route('Properties.index')->withFlashMessage('Company Property successfully updated!');
	}

	/**
	 * Remove the specified kin from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$property = Property::findOrFail($id);
		
		Property::destroy($id);

		Audit::logaudit('Properties', 'delete', 'deleted: '.$property->name);

		return Redirect::route('Properties.index')->withDeleteMessage('Company Property successfully deleted!');
	}

}
