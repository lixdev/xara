<?php

class BankBranchController extends \BaseController {

	/**
	 * Display a listing of branches
	 *
	 * @return Response
	 */
	public function index()
	{
		$bbranches = BBranch::all();

		Audit::logaudit('Bank branches', 'view', 'viewed bank branches');

		return View::make('bank_branch.index', compact('bbranches'));
	}

	/**
	 * Show the form for creating a new branch
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('bank_branch.create');
	}

	/**
	 * Store a newly created branch in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), BBranch::$rules,BBranch::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$bbranch = new BBranch;

		$bbranch->bank_branch_name = Input::get('name');

		$bbranch->branch_code = Input::get('code');

        $bbranch->organization_id = '1';

		$bbranch->save();

		Audit::logaudit('Bank Branch', 'create', 'created: '.$bbranch->bank_branch_name);

		return Redirect::route('bank_branch.index')->withFlashMessage('Bank Branch successfully created!');
	}

	/**
	 * Display the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$bbranch = BBranch::findOrFail($id);

		return View::make('bank_branch.show', compact('bbranch'));
	}

	/**
	 * Show the form for editing the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$bbranch = BBranch::find($id);

		return View::make('bank_branch.edit', compact('bbranch'));
	}

	/**
	 * Update the specified branch in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$bbranch = BBranch::findOrFail($id);

		$validator = Validator::make($data = Input::all(), BBranch::$rules,BBranch::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$bbranch->bank_branch_name = Input::get('name');
		$bbranch->branch_code = Input::get('code');
		$bbranch->update();

		Audit::logaudit('Bank Branch', 'update', 'updated: '.$bbranch->bank_branch_name);

		return Redirect::route('bank_branch.index')->withFlashMessage('Bank Branch successfully updated!');
	}

	/**
	 * Remove the specified branch from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$bbranch = BBranch::findOrFail($id);

		BBranch::destroy($id);

		Audit::logaudit('Bank Branch', 'delete', 'deleted: '.$bbranch->bank_branch_name);

		return Redirect::route('bank_branch.index')->withDeleteMessage('Bank Branch successfully deleted!');
	}

}
