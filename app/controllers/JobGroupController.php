<?php

class JobGroupController extends \BaseController {

	/**
	 * Display a listing of branches
	 *
	 * @return Response
	 */
	public function index()
	{
		$jgroups = JGroup::all();

		Audit::logaudit('Job Group', 'view', 'viewed employee job group');

		return View::make('job_group.index', compact('jgroups'));
	}

	/**
	 * Show the form for creating a new branch
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('job_group.create');
	}

	/**
	 * Store a newly created branch in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), JGroup::$rules,JGroup::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$jgroup = new JGroup;

		$jgroup->job_group_name = Input::get('name');

        $jgroup->organization_id = '1';

		$jgroup->save();

		Audit::logaudit('Job Groups', 'create', 'created: '.$jgroup->job_group_name);

		return Redirect::route('job_group.index')->withFlashMessage('Job group successfully created!');
	}

	/**
	 * Display the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$jgroup = JGroup::findOrFail($id);

		return View::make('job_group.show', compact('jgroup'));
	}

	/**
	 * Show the form for editing the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$jgroup = JGroup::find($id);

		return View::make('job_group.edit', compact('jgroup'));
	}

	/**
	 * Update the specified branch in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$jgroup = JGroup::findOrFail($id);

		$validator = Validator::make($data = Input::all(), JGroup::$rules,JGroup::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$jgroup->job_group_name = Input::get('name');
		$jgroup->update();
        
        Audit::logaudit('Job Groups', 'update', 'updated: '.$jgroup->job_group_name);

		return Redirect::route('job_group.index')->withFlashMessage('Job group successfully updated!');
	}

	/**
	 * Remove the specified branch from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$jgroup = JGroup::findOrFail($id);
		JGroup::destroy($id);
        Audit::logaudit('Job Groups', 'update', 'updated: '.$jgroup->job_group_name);
		return Redirect::route('job_group.index')->withDeleteMessage('Job group successfully deleted!');
	}

}
