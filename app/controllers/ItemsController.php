<?php

class ItemsController extends \BaseController {

	/**
	 * Display a listing of items
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = Item::all();

		return View::make('items.index', compact('items'));
	}

	/**
	 * Show the form for creating a new item
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('items.create');
	}

	/**
	 * Store a newly created item in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Item::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Item::create($data);

		return Redirect::route('items.index');
	}

	/**
	 * Display the specified item.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$item = Item::findOrFail($id);

		return View::make('items.show', compact('item'));
	}

	/**
	 * Show the form for editing the specified item.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$item = Item::find($id);

		return View::make('items.edit', compact('item'));
	}

	/**
	 * Update the specified item in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$item = Item::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Item::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$item->update($data);

		return Redirect::route('items.index');
	}

	/**
	 * Remove the specified item from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Item::destroy($id);

		return Redirect::route('items.index');
	}

}
