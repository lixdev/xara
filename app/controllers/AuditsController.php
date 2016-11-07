<?php

class AuditsController extends \BaseController {

	/**
	 * Display a listing of audits
	 *
	 * @return Response
	 */
	public function index()
	{
		$audits = Audit::where('organization_id',Confide::user()->organization_id)->get();

		return View::make('audits.index', compact('audits'));
	}

	/**
	 * Show the form for creating a new audit
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('audits.create');
	}

	/**
	 * Store a newly created audit in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Audit::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Audit::create($data);

		return Redirect::route('audits.index');
	}

	/**
	 * Display the specified audit.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$audit = Audit::findOrFail($id);

		return View::make('audits.show', compact('audit'));
	}

	/**
	 * Show the form for editing the specified audit.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$audit = Audit::find($id);

		return View::make('audits.edit', compact('audit'));
	}

	/**
	 * Update the specified audit in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$audit = Audit::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Audit::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$audit->update($data);

		return Redirect::route('audits.index');
	}

	/**
	 * Remove the specified audit from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Audit::destroy($id);

		return Redirect::route('audits.index');
	}

}
