<?php

class OrganizationsController extends \BaseController {

	/**
	 * Display a listing of organizations
	 *
	 * @return Response
	 */
	public function index()
	{

		$banks_db = DB::table('banks')
		->get();

		$organization = DB::table('organizations')->where('id', '=', Confide::user()->organization_id)->first();
       
       $bbranches_db = DB::table('bank_branches')
		->where('bank_id',$organization->bank_id)
		->get();

		return View::make('organizations.index', compact('organization','banks','bbranches','banks_db','bbranches_db'));
	
	}

	/**
	 * Show the form for creating a new organization
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('organizations.create');
	}

	/**
	 * Store a newly created organization in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Organization::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$organization = new Organization;




		return Redirect::route('organizations.index');
	}

	/**
	 * Display the specified organization.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$banks = DB::table('banks')
		->join('organizations', 'banks.id', '=', 'organizations.bank_id')
		->where('organization_id',Confide::user()->organization_id)
		->where('organization_id',1)
		->get();

		$bbranches = DB::table('bank_branches')
                ->join('organizations', 'bank_branches.id', '=', 'organizations.bank_branch_id')
                ->where('organization_id',Confide::user()->organization_id)
		->where('organization_id',1)
		->get();

		$organization = Organization::findOrFail($id);

		return View::make('organizations.show', compact('organization','banks','bbranches'));
	}

	/**
	 * Show the form for editing the specified organization.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$organization = Organization::find($id);

		return View::make('organizations.edit', compact('organization'));
	}

	/**
	 * Update the specified organization in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$organization = Organization::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Organization::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$organization->name = Input::get('name');
		$organization->phone = Input::get('phone');
		$organization->email = Input::get('email');
		$organization->address = Input::get('address');
		$organization->website = Input::get('website');
		$organization->kra_pin = Input::get('pin');
		$organization->nssf_no = Input::get('nssf');
		$organization->nhif_no = Input::get('nhif');
		$organization->bank_id = Input::get('bank_id');
		$organization->bank_branch_id = Input::get('bbranch_id');
		$organization->bank_account_number = Input::get('acc');
		$organization->swift_code = Input::get('code');
		/*if(Input::get('payroll_activate') != null ){
        $organization->is_payroll_active = 1;
        }else{
        $organization->is_payroll_active = 0;
        }
        if(Input::get('erp_activate') != null ){
        $organization->is_erp_active = 1;
        }else{
        $organization->is_erp_active = 0;
        }
        if(Input::get('cbs_activate') != null ){
        $organization->is_cbs_active = 1;
        }else{
        $organization->is_cbs_active = 0;
        }*/
		$organization->update();

		return Redirect::route('organizations.index');
	}

	/**
	 * Remove the specified organization from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Organization::destroy($id);

		return Redirect::route('organizations.index');
	}





	public function generate_license_key(){

		$license_code = Input::get('license_code');
		$org_name = Input::get('name');
		


		$organization = new Organization;


		$license_key = $organization->license_key_generator($license_code);


		return View::make('admin.license_view', compact('license_key','org_name','license_code'));


	}



	public function activate_license_form($id){

		$organization = Organization::findOrFail($id);


		return View::make('activate', compact('organization'));
	}


	public function activate_license(){

		$organization = Organization::findOrFail(Input::get('org_id'));

		$license_key = Input::get('license_key');


		$valid = $organization->license_key_validator($license_key, $organization->license_code, $organization->name);


		if($valid){

			$organization->license_key = $license_key;
			$organization->license_type = 'commercial';
			$organization->licensed = 100;
			$organization->update();

			return Redirect::to('/');

		} else {

			return View::make('activate', compact('organization'))->withErrors('License activation failed. License Key not valid');

		}

		
	}

public function logo($id){


	
if(Input::hasFile('photo')){

			$destination = public_path().'/uploads/logo/';

			$filename = str_random(12);

			$ext = Input::file('photo')->getClientOriginalExtension();
			$photo = $filename.'.'.$ext;
			
			
			Input::file('photo')->move($destination, $photo);

			
			$organization = Organization::findOrFail($id);
			
			$organization->logo = $photo;
			$organization->update();
			
		}

		return Redirect::to('organizations');
}



public function language($lang){



   Session::put('lang', $lang);

    return Redirect::back();

    

}





}
