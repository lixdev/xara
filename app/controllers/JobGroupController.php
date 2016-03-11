<?php

class JobGroupController extends \BaseController {

	/**
	 * Display a listing of branches
	 *
	 * @return Response
	 */
	public function index()
	{
		$jgroups = Jobgroup::all();
		$benefits = Benefitsetting::all();

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
		$benefits = Benefitsetting::all();
		return View::make('job_group.create', compact('benefits'));
	}

	/**
	 * Store a newly created branch in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Jobgroup::$rules,Jobgroup::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$count = DB::table('benefitsettings')->count();

		$c = count(Input::get('benefitid'));

		$ben = Input::get('benefitid');

        $amt = str_replace( ',', '', Input::get('amount'));

		$jgroup = new Jobgroup;

		$jgroup->job_group_name = Input::get('name');

        $jgroup->organization_id = '1';

        $jgroup->save();

        $id = Jobgroup::orderBy('id','DESC')->first();

        for ( $i=0; $i< $count; $i++) {

        $benefit = new Employeebenefit;
        $benefit->jobgroup_id=$id->id ;

        if(filter_var($ben[$i], FILTER_VALIDATE_BOOLEAN)){
        $benefit->benefit_id = $ben[$i];
        $benefit->amount = $amt[$i];

        }else{
        $benefit->benefit_id = $ben[$i];
        $benefit->amount = $amt[$i+1];
        }

        $benefit->save();
    
        }

		

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
		$jobgroup = Jobgroup::findOrFail($id);

		$benefits = Benefitsetting::all();

		return View::make('job_group.show', compact('jobgroup','benefits'));
	}

	/**
	 * Show the form for editing the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$jobgroup = Jobgroup::find($id);

		$benefits = Benefitsetting::all();

		$amounts=DB::table('employeebenefits')->where('jobgroup_id',$id)->get();

		$count = DB::table('employeebenefits')->where('jobgroup_id',$id)->count();

		return View::make('job_group.edit', compact('jobgroup','benefits','count','amounts'));
	}

	/**
	 * Update the specified branch in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$jgroup = Jobgroup::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Jobgroup::$rules,Jobgroup::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
        $c = count(Input::get('benefitid'));

		$ben = Input::get('benefitid');
        $amt = str_replace( ',', '', Input::get('amount') );


		$jgroup->job_group_name = Input::get('name');
		$jgroup->update();

		DB::table('employeebenefits')->where('jobgroup_id',$id)->delete();

        for ( $i=0; $i< $c; $i++) {

        $benefit = new Employeebenefit;

        $benefit->jobgroup_id=$id;
        $benefit->benefit_id = $ben[$i];
        $benefit->amount = $amt[$i];
        $benefit->save();
    
        }

        
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
		$jgroup = Jobgroup::findOrFail($id);
		Jobgroup::destroy($id);
		DB::table('employeebenefits')->where('jobgroup_id',$id)->delete();
        Audit::logaudit('Job Groups', 'update', 'updated: '.$jgroup->job_group_name);
		return Redirect::route('job_group.index')->withDeleteMessage('Job group successfully deleted!');
	}

}
