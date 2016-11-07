<?php

class CurrenciesController extends \BaseController {

	/**
	 * Display a listing of currencies
	 *
	 * @return Response
	 */
	public function index()
	{
		$currencies = Currency::whereNull('organization_id')->orWhere('organization_id',Confide::user()->organization_id)->get();

		return View::make('currencies.index', compact('currencies'));
	}

	/**
	 * Show the form for creating a new currency
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('currencies.create');
	}

	/**
	 * Store a newly created currency in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Currency::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$currency = new Currency;

		$currency->name = Input::get('name');
		$currency->shortname = Input::get('shortname');
		$currency->organization_id = Confide::user()->organization_id;
		$currency->save();

		Audit::logaudit('Currency', 'create', 'created: '.$currency->name);


		return Redirect::route('currencies.index');
	}

	/**
	 * Display the specified currency.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$currency = Currency::whereNull('organization_id')->orWhere('organization_id',Confide::user()->organization_id)->get();

		Audit::logaudit('Currency', 'view', 'viewed: '.$currency->name);

		return View::make('currencies.show', compact('currency'));

	}

	/**
	 * Show the form for editing the specified currency.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$currency = Currency::find($id);

		return View::make('currencies.edit', compact('currency'));
	}

	/**
	 * Update the specified currency in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$currency = Currency::find($id);

		$validator = Validator::make($data = Input::all(), Currency::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$currency->name = Input::get('name');
		$currency->shortname = Input::get('shortname');
		$currency->update();

		Audit::logaudit('Currency', 'update', 'updated: '.$currency->name);

		return Redirect::route('currencies.index');
	}

	/**
	 * Remove the specified currency from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$currency = Currency::findOrFail($id);
		Currency::destroy($id);

		Audit::logaudit('Currency', 'delete', 'deleted: '.$currency->name);

		return Redirect::route('currencies.index');
	}

}
