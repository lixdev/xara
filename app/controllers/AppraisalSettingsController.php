<?php

class AppraisalSettingsController extends \BaseController {

	/**
	 * Display a listing of branches
	 *
	 * @return Response
	 */
	public function index()
	{
		$appraisals = Appraisalquestion::all();

		Audit::logaudit('Appraisal Settings', 'view', 'viewed appraisal settings');

		return View::make('appraisalsettings.index', compact('appraisals'));
	}

	/**
	 * Show the form for creating a new branch
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('appraisalsettings.create');
	}

	/**
	 * Store a newly created branch in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Appraisalquestion::$rules,Appraisalquestion::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$appraisal = new Appraisalquestion;

		$appraisal->category = Input::get('category');

        $appraisal->question = Input::get('question');

        $appraisal->rate = Input::get('rate');

		$appraisal->save();

		Audit::logaudit('Appraisal Question', 'create', 'created: '.$appraisal->question);


		return Redirect::route('AppraisalSettings.index')->withFlashMessage('Appraisal Settings successfully created!');
	}

	/**
	 * Display the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$appraisal = Appraisalquestion::findOrFail($id);

		return View::make('appraisalsettings.show', compact('appraisal'));
	}

	/**
	 * Show the form for editing the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$appraisal = Appraisalquestion::find($id);

		return View::make('appraisalsettings.edit', compact('appraisal'));
	}

	/**
	 * Update the specified branch in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$appraisal = Appraisalquestion::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Appraisalquestion::$rules,Appraisalquestion::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$appraisal->category = Input::get('category');

        $appraisal->question = Input::get('question');

        $appraisal->rate = Input::get('rate');

		$appraisal->update();

		Audit::logaudit('Appraisal Question', 'update', 'updated: '.$appraisal->question);


		return Redirect::route('AppraisalSettings.index')->withFlashMessage('Appraisal Settings successfully updated!');
	}

	/**
	 * Remove the specified branch from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$appraisal = Appraisalquestion::findOrFail($id);
		
		Appraisalquestion::destroy($id);

		Audit::logaudit('Appraisal Question', 'delete', 'deleted: '.$appraisal->question);


		return Redirect::route('AppraisalSettings.index')->withDeleteMessage('Appraisal Settings successfully deleted!');
	}

}
