<?php

class ExpensesController extends \BaseController {

	/**
	 * Display a listing of expenses
	 *
	 * @return Response
	 */
	public function index()
	{
		$expenses = Expense::all();

		Audit::logaudit('Expenses', 'view', 'viewed expenses');

		return View::make('expenses.index', compact('expenses'));
	}

	/**
	 * Show the form for creating a new expense
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('expenses.create');
	}

	/**
	 * Store a newly created expense in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Expense::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Expense::create($data);

		return Redirect::route('expenses.index')->withFlashMessage('Expenses successfully created!');
	}

	/**
	 * Display the specified expense.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$expense = Expense::findOrFail($id);

		return View::make('expenses.show', compact('expense'));
	}

	/**
	 * Show the form for editing the specified expense.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$expense = Expense::find($id);

		return View::make('expenses.edit', compact('expense'));
	}

	/**
	 * Update the specified expense in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$expense = Expense::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Expense::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$expense->update($data);

		return Redirect::route('expenses.index')->withFlashMessage('Expenses successfully updated!');
	}

	/**
	 * Remove the specified expense from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$expense = Expense::findOrFail($id);
		Expense::destroy($id);
        Audit::logaudit('Expenses', 'delete', 'deleted: '.$expense->name);
		return Redirect::route('expenses.index')->withDeleteMessage('Expenses successfully deleted!');
	}

}
