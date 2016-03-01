<?php

class AppraisalsController extends \BaseController {

	/**
	 * Display a listing of branches
	 *
	 * @return Response
	 */
	public function index()
	{
		$appraisals = Appraisal::all();

		return View::make('appraisals.index', compact('appraisals'));
	}

	/**
	 * Show the form for creating a new branch
	 *
	 * @return Response
	 */
	public function create()
	{
		$employees = Employee::all();
		$appraisals = Appraisalquestion::all();
		return View::make('appraisals.create',compact('employees','appraisals'));
	}

	/**
	 * Store a newly created branch in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Appraisal::$rules,Appraisal::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$appraisal = new Appraisal;

		$appraisal->employee_id = Input::get('employee_id');

		$appraisal->appraisalquestion_id = Input::get('appraisal_id');

        $appraisal->performance = Input::get('performance');

        $appraisal->rate = Input::get('score');

        $appraisal->examiner = Confide::user()->id;

        $appraisal->appraisaldate = Input::get('date');

        $appraisal->comment = Input::get('comment');

		$appraisal->save();

		Audit::logaudit('Employee Appraisal', 'create', 'created: '.$appraisal->question);


		return Redirect::route('Appraisals.index')->withFlashMessage('Employee Appraisal successfully created!');
	}

	/**
	 * Display the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$appraisal = Appraisal::findOrFail($id);

		return View::make('appraisals.show', compact('appraisal'));
	}

	/**
	 * Show the form for editing the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$appraisal = Appraisal::find($id);
		$appraisalqs = Appraisalquestion::all();
		$user = User::find($appraisal->examiner);

		return View::make('appraisals.edit', compact('appraisal','appraisalqs','user'));
	}

	/**
	 * Update the specified branch in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$appraisal = Appraisal::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Appraisal::$rules,Appraisal::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$appraisal->appraisalquestion_id = Input::get('appraisal_id');

        $appraisal->performance = Input::get('performance');

        $appraisal->rate = Input::get('score');

        $appraisal->comment = Input::get('comment');

		$appraisal->update();

		Audit::logaudit('Appraisal Question', 'update', 'updated: '.$appraisal->question);


		return Redirect::route('Appraisals.index')->withFlashMessage('Employee Appraisal successfully updated!');
	}

	/**
	 * Remove the specified branch from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$appraisal = Appraisal::findOrFail($id);
		
		Appraisal::destroy($id);

		Audit::logaudit('Employee Appraisal', 'delete', 'deleted: '.$appraisal->question);


		return Redirect::route('Appraisals.index')->withDeleteMessage('Employee Appraisal successfully deleted!');
	}

}
