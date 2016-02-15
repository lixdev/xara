<?php

class ItemcategoriesController extends \BaseController {

	/**
	 * Display a listing of itemcategories
	 *
	 * @return Response
	 */
	public function index()
	{
		$itemcategories = Itemcategory::all();

		return View::make('itemcategories.index', compact('itemcategories'));
	}

	/**
	 * Show the form for creating a new itemcategory
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('itemcategories.create');
	}

	/**
	 * Store a newly created itemcategory in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Itemcategory::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$category = new Itemcategory;

		$category->name = Input::get('name');
		$category->category = Input::get('category');
		$category->save();

		return Redirect::route('itemcategories.index');
	}

	/**
	 * Display the specified itemcategory.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$itemcategory = Itemcategory::findOrFail($id);

		return View::make('itemcategories.show', compact('itemcategory'));
	}

	/**
	 * Show the form for editing the specified itemcategory.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$itemcategory = Itemcategory::find($id);

		return View::make('itemcategories.edit', compact('itemcategory'));
	}

	/**
	 * Update the specified itemcategory in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$category = Itemcategory::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Itemcategory::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$category->name = Input::get('name');
		$category->category = Input::get('category');
		$category->update();

		return Redirect::route('itemcategories.index');
	}

	/**
	 * Remove the specified itemcategory from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Itemcategory::destroy($id);

		return Redirect::route('itemcategories.index');
	}

}
