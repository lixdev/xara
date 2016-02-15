<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/', function()
{

    $count = count(User::all());

    if($count <= 1 ){

        return View::make('login');
    }


	if (Confide::user()) {

   

        return Redirect::to('/dashboard');
        } else {
            return View::make('login');
        }
});



Route::get('/dashboard', function()
{
	if (Confide::user()) {


        if(Confide::user()->user_type == 'admin'){

             
          $employees = Employee::all();
           return View::make('dashboard', compact('employees'));



        } 


        if(Confide::user()->user_type == 'member'){

          $employee_id = DB::table('employee')->where('personal_file_number', '=', Confide::user()->username)->pluck('id');

             
          $employee = Employee::findorfail($employee_id);
           return View::make('empdash', compact('employee'));



        } 

        

      
        } else {
            return View::make('login');
        }
});
//

Route::get('fpassword', function(){

  return View::make(Config::get('confide::forgot_password_form'));

});
// Confide routes
Route::resource('users', 'UsersController');
Route::get('users/create', 'UsersController@create');
Route::get('users/edit/{user}', 'UsersController@edit');
Route::post('users/update/{user}', 'UsersController@update');
Route::post('users', 'UsersController@store');
Route::get('users/add', 'UsersController@add');
Route::post('users/newuser', 'UsersController@newuser');
Route::get('users/login', 'UsersController@login');
Route::post('users/login', 'UsersController@doLogin');
Route::get('users/confirm/{code}', 'UsersController@confirm');
Route::get('users/forgot_password', 'UsersController@forgotPassword');
Route::post('users/forgot_password', 'UsersController@doForgotPassword');
Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
Route::post('users/reset_password', 'UsersController@doResetPassword');
Route::get('users/logout', 'UsersController@logout');
Route::get('users/activate/{user}', 'UsersController@activate');
Route::get('users/deactivate/{user}', 'UsersController@deactivate');
Route::get('users/destroy/{user}', 'UsersController@destroy');
Route::get('users/password/{user}', 'UsersController@Password');
Route::post('users/password/{user}', 'UsersController@changePassword');
Route::get('users/profile/{user}', 'UsersController@profile');
Route::get('users/show/{user}', 'UsersController@show');



Route::post('users/pass', 'UsersController@changePassword2');

Route::group(['before' => 'manage_roles'], function() {

Route::resource('roles', 'RolesController');
Route::get('roles/create', 'RolesController@create');
Route::get('roles/edit/{id}', 'RolesController@edit');
Route::post('roles/update/{id}', 'RolesController@update');
Route::get('roles/delete/{id}', 'RolesController@destroy');

});

Route::get('import', function(){

    return View::make('import');
});


Route::group(['before' => 'manage_system'], function() {

Route::get('system', function(){


    $organization = Organization::find(1);

    return View::make('system.index', compact('organization'));
});

});



Route::get('license', function(){


    $organization = Organization::find(1);

    return View::make('system.license', compact('organization'));
});




/**
* Organization routes
*/

Route::group(['before' => 'manage_organization'], function() {

Route::resource('organizations', 'OrganizationsController');

Route::post('organizations/update/{id}', 'OrganizationsController@update');
Route::post('organizations/logo/{id}', 'OrganizationsController@logo');

});

Route::get('language/{lang}', 
           array(
                  'as' => 'language.select', 
                  'uses' => 'OrganizationsController@language'
                 )
          );



Route::resource('currencies', 'CurrenciesController');
Route::get('currencies/edit/{id}', 'CurrenciesController@edit');
Route::post('currencies/update/{id}', 'CurrenciesController@update');
Route::get('currencies/delete/{id}', 'CurrenciesController@destroy');
Route::get('currencies/create', 'CurrenciesController@create');



/*
* branches routes
*/

Route::group(['before' => 'manage_branches'], function() {

Route::resource('branches', 'BranchesController');
Route::post('branches/update/{id}', 'BranchesController@update');
Route::get('branches/delete/{id}', 'BranchesController@destroy');
Route::get('branches/edit/{id}', 'BranchesController@edit');
});
/*
* groups routes
*/
Route::group(['before' => 'manage_groups'], function() {

Route::resource('groups', 'GroupsController');
Route::post('groups/update/{id}', 'GroupsController@update');
Route::get('groups/delete/{id}', 'GroupsController@destroy');
Route::get('groups/edit/{id}', 'GroupsController@edit');
});

/*
* accounts routes
*/

Route::group(['before' => 'process_payroll'], function() {

Route::resource('accounts', 'AccountsController');
Route::post('accounts/update/{id}', 'AccountsController@update');
Route::get('accounts/delete/{id}', 'AccountsController@destroy');
Route::get('accounts/edit/{id}', 'AccountsController@edit');
Route::get('accounts/show/{id}', 'AccountsController@show');
Route::get('accounts/create/{id}', 'AccountsController@create');

});

/*
* journals routes
*/
Route::resource('journals', 'JournalsController');
Route::post('journals/update/{id}', 'JournalsController@update');
Route::get('journals/delete/{id}', 'JournalsController@destroy');
Route::get('journals/edit/{id}', 'JournalsController@edit');
Route::get('journals/show/{id}', 'JournalsController@show');



/*
* license routes
*/

Route::post('license/key', 'OrganizationsController@generate_license_key');
Route::post('license/activate', 'OrganizationsController@activate_license');
Route::get('license/activate/{id}', 'OrganizationsController@activate_license_form');

/*
* Audits routes
*/
Route::group(['before' => 'manage_audits'], function() {

Route::resource('audits', 'AuditsController');

});

/*
* backups routes
*/

Route::get('backups', function(){

   
    //$backups = Backup::getRestorationFiles('../app/storage/backup/');

    return View::make('backup');

});


Route::get('backups/create', function(){

    echo '<pre>';

    $instance = Backup::getBackupEngineInstance();

    print_r($instance);

    //Backup::setPath(public_path().'/backups/');

   //Backup::export();
    //$backups = Backup::getRestorationFiles('../app/storage/backup/');

    //return View::make('backup');

});







/*
* #####################################################################################################################
*/
Route::group(['before' => 'manage_holiday'], function() {

Route::resource('holidays', 'HolidaysController');
Route::get('holidays/edit/{id}', 'HolidaysController@edit');
Route::get('holidays/delete/{id}', 'HolidaysController@destroy');
Route::post('holidays/update/{id}', 'HolidaysController@update');

});

Route::group(['before' => 'manage_leavetype'], function() {

Route::resource('leavetypes', 'LeavetypesController');
Route::get('leavetypes/edit/{id}', 'LeavetypesController@edit');
Route::get('leavetypes/delete/{id}', 'LeavetypesController@destroy');
Route::post('leavetypes/update/{id}', 'LeavetypesController@update');

});


Route::resource('leaveapplications', 'LeaveapplicationsController');
Route::get('leaveapplications/edit/{id}', 'LeaveapplicationsController@edit');
Route::get('leaveapplications/delete/{id}', 'LeaveapplicationsController@destroy');
Route::post('leaveapplications/update/{id}', 'LeaveapplicationsController@update');
Route::get('leaveapplications/approve/{id}', 'LeaveapplicationsController@approve');
Route::post('leaveapplications/approve/{id}', 'LeaveapplicationsController@doapprove');
Route::get('leaveapplications/cancel', 'LeaveapplicationsController@cancel');
Route::get('leaveapplications/reject/{id}', 'LeaveapplicationsController@reject');
Route::get('leaveapplications/show/{id}', 'LeaveapplicationsController@show');

Route::get('leaveapplications/approvals', 'LeaveapplicationsController@approvals');
Route::get('leaveapplications/rejects', 'LeaveapplicationsController@rejects');
Route::get('leaveapplications/cancellations', 'LeaveapplicationsController@cancellations');
Route::get('leaveapplications/amends', 'LeaveapplicationsController@amended');


Route::get('leaveapprovals', function(){

  $leaveapplications = Leaveapplication::all();

  return View::make('leaveapplications.approved', compact('leaveapplications'));

} );

Route::group(['before' => 'amend_application'], function() {

Route::get('leaveamends', function(){

  $leaveapplications = Leaveapplication::all();

  return View::make('leaveapplications.amended', compact('leaveapplications'));

} );

});

Route::group(['before' => 'reject_application'], function() {

Route::get('leaverejects', function(){

  $leaveapplications = Leaveapplication::all();

  return View::make('leaveapplications.rejected', compact('leaveapplications'));

} );

});

Route::group(['before' => 'manage_settings'], function() {

Route::get('migrate', function(){

    return View::make('migration');

});

});


/*
* Template routes and generators 
*/


Route::get('template/employees', function(){

  $bank_data = Bank::all();

  $data = Employee::all();

  $employees = Employee::all();

  $bankbranch_data = BBranch::all();
 
  $branch_data = Branch::all();

  $department_data = Department::all();

  $employeetype_data = EType::all();

  $jobgroup_data = JGroup::all();

  Excel::create('Employees', function($excel) use($bank_data, $bankbranch_data, $branch_data, $department_data, $employeetype_data, $jobgroup_data,$employees, $data) {


    require_once(base_path()."/vendor/phpoffice/phpexcel/Classes/PHPExcel/NamedRange.php");
    require_once(base_path()."/vendor/phpoffice/phpexcel/Classes/PHPExcel/Cell/DataValidation.php");

    

    $excel->sheet('employees', function($sheet) use($bank_data, $bankbranch_data, $branch_data, $department_data, $employeetype_data, $jobgroup_data, $data, $employees){


              $sheet->row(1, array(
     'EMPLOYMENT NUMBER','FIRST NAME', 'SURNAME', 'OTHER NAMES', 'ID NUMBER', 'KRA PIN', 'NSSF NUMBER', 'NHIF NUMBER','EMAIL ADDRESS','BASIC PAY'
));

             
                $empdata = array();

                foreach($employees as $d){

                  $empdata[] = $d->personal_file_number.':'.$d->first_name.' '.$d->last_name.' '.$d->middle_name;
                }

                $emplist = implode(", ", $empdata);

                

                $listdata = array();

                foreach($data as $d){

                  $listdata[] = $d->allowance_name;
                }

                $list = implode(", ", $listdata);
   

    

                

                
        

    });

  })->export('xls');
});


/*
*allowance template
*
*/

Route::get('template/allowances', function(){

  $data = Allowance::all();
  $employees = Employee::all();


  Excel::create('Allowances', function($excel) use($data, $employees) {

    require_once(base_path()."/vendor/phpoffice/phpexcel/Classes/PHPExcel/NamedRange.php");
    require_once(base_path()."/vendor/phpoffice/phpexcel/Classes/PHPExcel/Cell/DataValidation.php");

    

    $excel->sheet('allowances', function($sheet) use($data, $employees){


              $sheet->row(1, array(
     'EMPLOYEE', 'ALLOWANCE TYPE', 'AMOUNT'
));

             
                $empdata = array();

                foreach($employees as $d){

                  $empdata[] = $d->personal_file_number.':'.$d->first_name.' '.$d->last_name.' '.$d->middle_name;
                }

                $emplist = implode(", ", $empdata);

                

                $listdata = array();

                foreach($data as $d){

                  $listdata[] = $d->allowance_name;
                }

                $list = implode(", ", $listdata);
   

    for($i=2; $i <= 250; $i++){

                $objValidation = $sheet->getCell('B'.$i)->getDataValidation();
                $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                $objValidation->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                $objValidation->setAllowBlank(false);
                $objValidation->setShowInputMessage(true);
                $objValidation->setShowErrorMessage(true);
                $objValidation->setShowDropDown(true);
                $objValidation->setErrorTitle('Input error');
                $objValidation->setError('Value is not in list.');
                $objValidation->setPromptTitle('Pick from list');
                $objValidation->setPrompt('Please pick a value from the drop-down list.');
                $objValidation->setFormula1('"'.$list.'"'); //note this!



                $objValidation = $sheet->getCell('A'.$i)->getDataValidation();
                $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                $objValidation->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                $objValidation->setAllowBlank(false);
                $objValidation->setShowInputMessage(true);
                $objValidation->setShowErrorMessage(true);
                $objValidation->setShowDropDown(true);
                $objValidation->setErrorTitle('Input error');
                $objValidation->setError('Value is not in list.');
                $objValidation->setPromptTitle('Pick from list');
                $objValidation->setPrompt('Please pick a value from the drop-down list.');
                $objValidation->setFormula1('"'.$emplist.'"'); //note this!

    }

                

                
        

    });

  })->export('xls');



});

/*
*earning template
*
*/

Route::get('template/earnings', function(){

  $employees = Employee::all();


  Excel::create('Earnings', function($excel) use($employees) {

    require_once(base_path()."/vendor/phpoffice/phpexcel/Classes/PHPExcel/NamedRange.php");
    require_once(base_path()."/vendor/phpoffice/phpexcel/Classes/PHPExcel/Cell/DataValidation.php");

    

    $excel->sheet('earnings', function($sheet) use($employees){


              $sheet->row(1, array(
     'EMPLOYEE', 'EARNING TYPE','NARRATIVE', 'AMOUNT'
));

             
                $empdata = array();

                foreach($employees as $d){

                  $empdata[] = $d->personal_file_number.':'.$d->first_name.' '.$d->last_name.' '.$d->middle_name;
                }

                $emplist = implode(", ", $empdata);

                
   

    for($i=2; $i <= 250; $i++){

                $objValidation = $sheet->getCell('B'.$i)->getDataValidation();
                $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                $objValidation->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                $objValidation->setAllowBlank(false);
                $objValidation->setShowInputMessage(true);
                $objValidation->setShowErrorMessage(true);
                $objValidation->setShowDropDown(true);
                $objValidation->setErrorTitle('Input error');
                $objValidation->setError('Value is not in list.');
                $objValidation->setPromptTitle('Pick from list');
                $objValidation->setPrompt('Please pick a value from the drop-down list.');
                $objValidation->setFormula1('"Bonus, Commission, Others"'); //note this!



                $objValidation = $sheet->getCell('A'.$i)->getDataValidation();
                $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                $objValidation->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                $objValidation->setAllowBlank(false);
                $objValidation->setShowInputMessage(true);
                $objValidation->setShowErrorMessage(true);
                $objValidation->setShowDropDown(true);
                $objValidation->setErrorTitle('Input error');
                $objValidation->setError('Value is not in list.');
                $objValidation->setPromptTitle('Pick from list');
                $objValidation->setPrompt('Please pick a value from the drop-down list.');
                $objValidation->setFormula1('"'.$emplist.'"'); //note this!

    }

                

                
        

    });

  })->export('xls');



});

/*
*Relief template
*
*/

Route::get('template/reliefs', function(){

  $employees = Employee::all();
  
  $data = Relief::all();

  Excel::create('Reliefs', function($excel) use($employees, $data) {

    require_once(base_path()."/vendor/phpoffice/phpexcel/Classes/PHPExcel/NamedRange.php");
    require_once(base_path()."/vendor/phpoffice/phpexcel/Classes/PHPExcel/Cell/DataValidation.php");

    

    $excel->sheet('reliefs', function($sheet) use($employees, $data){


              $sheet->row(1, array(
     'EMPLOYEE', 'RELIEF TYPE', 'AMOUNT'
));

             
                $empdata = array();

                foreach($employees as $d){

                  $empdata[] = $d->personal_file_number.':'.$d->first_name.' '.$d->last_name.' '.$d->middle_name;
                }

                $emplist = implode(", ", $empdata);

                
                $listdata = array();

                foreach($data as $d){

                  $listdata[] = $d->relief_name;
                }

                $list = implode(", ", $listdata);
   

    for($i=2; $i <= 250; $i++){

                $objValidation = $sheet->getCell('B'.$i)->getDataValidation();
                $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                $objValidation->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                $objValidation->setAllowBlank(false);
                $objValidation->setShowInputMessage(true);
                $objValidation->setShowErrorMessage(true);
                $objValidation->setShowDropDown(true);
                $objValidation->setErrorTitle('Input error');
                $objValidation->setError('Value is not in list.');
                $objValidation->setPromptTitle('Pick from list');
                $objValidation->setPrompt('Please pick a value from the drop-down list.');
                $objValidation->setFormula1('"'.$list.'"'); //note this!



                $objValidation = $sheet->getCell('A'.$i)->getDataValidation();
                $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                $objValidation->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                $objValidation->setAllowBlank(false);
                $objValidation->setShowInputMessage(true);
                $objValidation->setShowErrorMessage(true);
                $objValidation->setShowDropDown(true);
                $objValidation->setErrorTitle('Input error');
                $objValidation->setError('Value is not in list.');
                $objValidation->setPromptTitle('Pick from list');
                $objValidation->setPrompt('Please pick a value from the drop-down list.');
                $objValidation->setFormula1('"'.$emplist.'"'); //note this!

    }

                

                
        

    });

  })->export('xls');



});



/*
*deduction template
*
*/

Route::get('template/deductions', function(){

  $data = Deduction::all();
  $employees = Employee::all();


  Excel::create('Deductions', function($excel) use($data, $employees) {

    require_once(base_path()."/vendor/phpoffice/phpexcel/Classes/PHPExcel/NamedRange.php");
    require_once(base_path()."/vendor/phpoffice/phpexcel/Classes/PHPExcel/Cell/DataValidation.php");

    

    $excel->sheet('deductions', function($sheet) use($data, $employees){


              $sheet->row(1, array(
     'EMPLOYEE', 'DEDUCTION TYPE', 'AMOUNT','Date'
));

             
                $empdata = array();

                foreach($employees as $d){

                  $empdata[] = $d->personal_file_number.':'.$d->first_name.' '.$d->last_name.' '.$d->middle_name;
                }

                $emplist = implode(", ", $empdata);

                

                $listdata = array();

                foreach($data as $d){

                  $listdata[] = $d->deduction_name;
                }

                $list = implode(", ", $listdata);
   

    for($i=2; $i <= 250; $i++){

                $objValidation = $sheet->getCell('B'.$i)->getDataValidation();
                $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                $objValidation->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                $objValidation->setAllowBlank(false);
                $objValidation->setShowInputMessage(true);
                $objValidation->setShowErrorMessage(true);
                $objValidation->setShowDropDown(true);
                $objValidation->setErrorTitle('Input error');
                $objValidation->setError('Value is not in list.');
                $objValidation->setPromptTitle('Pick from list');
                $objValidation->setPrompt('Please pick a value from the drop-down list.');
                $objValidation->setFormula1('"'.$list.'"'); //note this!



                $objValidation = $sheet->getCell('A'.$i)->getDataValidation();
                $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                $objValidation->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                $objValidation->setAllowBlank(false);
                $objValidation->setShowInputMessage(true);
                $objValidation->setShowErrorMessage(true);
                $objValidation->setShowDropDown(true);
                $objValidation->setErrorTitle('Input error');
                $objValidation->setError('Value is not in list.');
                $objValidation->setPromptTitle('Pick from list');
                $objValidation->setPrompt('Please pick a value from the drop-down list.');
                $objValidation->setFormula1('"'.$emplist.'"'); //note this!

    }

                

                
        

    });

  })->export('xls');



});



/* #################### IMPORT EMPLOYEES ################################## */

Route::post('import/employees', function(){

  
  if(Input::hasFile('employees')){

      $destination = public_path().'/migrations/';

      $filename = str_random(12);

      $ext = Input::file('employees')->getClientOriginalExtension();
      $file = $filename.'.'.$ext;



      
      
     
      Input::file('employees')->move($destination, $file);


  


    Excel::selectSheetsByIndex(0)->load(public_path().'/migrations/'.$file, function($reader){

          $results = $reader->get();    
  
    foreach ($results as $result) {



      $employee = new Employee;

      $employee->personal_file_number = $result->employment_number;
      
      $employee->first_name = $result->first_name;
      $employee->last_name = $result->surname;
      $employee->middle_name = $result->other_names;
      $employee->identity_number = $result->id_number;
      $employee->pin = $result->kra_pin;
      $employee->social_security_number = $result->nssf_number;
      $employee->hospital_insurance_number = $result->nhif_number;
      $employee->email_office = $result->email_address;
      $employee->basic_pay = $result->basic_pay;
      $employee->save();
      
    }
    

    

  });



      
    }



  return Redirect::back()->with('notice', 'Employees have been succeffully imported');



  

});




/* #################### IMPORT EARNINGS ################################## */

Route::post('import/earnings', function(){

  
  if(Input::hasFile('earnings')){

      $destination = public_path().'/migrations/';

      $filename = str_random(12);

      $ext = Input::file('earnings')->getClientOriginalExtension();
      $file = $filename.'.'.$ext;

     
      Input::file('earnings')->move($destination, $file);


    Excel::selectSheetsByIndex(0)->load(public_path().'/migrations/'.$file, function($reader){

          $results = $reader->get();    
  
    foreach ($results as $result) {

    $name = explode(':', $result->employee);

    
    $employeeid = DB::table('employee')->where('personal_file_number', '=', $name[0])->pluck('id');

    $earning = new Earnings;

    $earning->employee_id = $employeeid;

    $earning->earnings_name = $result->earning_type;

    $earning->narrative = $result->narrative;

    $earning->earnings_amount = $result->amount;

    $earning->save();
      
    }
    

    

  });



      
    }



  return Redirect::back()->with('notice', 'earnings have been succeffully imported');



  

});


/* #################### IMPORT RELIEFS ################################## */

Route::post('import/reliefs', function(){

  
  if(Input::hasFile('reliefs')){

      $destination = public_path().'/migrations/';

      $filename = str_random(12);

      $ext = Input::file('reliefs')->getClientOriginalExtension();
      $file = $filename.'.'.$ext;

     
      Input::file('reliefs')->move($destination, $file);


    Excel::selectSheetsByIndex(0)->load(public_path().'/migrations/'.$file, function($reader){

          $results = $reader->get();    
  
    foreach ($results as $result) {

    $name = explode(':', $result->employee);

    
    $employeeid = DB::table('employee')->where('personal_file_number', '=', $name[0])->pluck('id');

    $reliefid = DB::table('relief')->where('relief_name', '=', $result->relief_type)->pluck('id');

    $relief = new ERelief;

    $relief->employee_id = $employeeid;

    $relief->relief_id = $reliefid;

    $relief->relief_amount = $result->amount;

    $relief->save();
      
    }
    

    

  });



      
    }



  return Redirect::back()->with('notice', 'reliefs have been succeffully imported');



  

});



/* #################### IMPORT ALLOWANCES ################################## */

Route::post('import/allowances', function(){

  
  if(Input::hasFile('allowances')){

      $destination = public_path().'/migrations/';

      $filename = str_random(12);

      $ext = Input::file('allowances')->getClientOriginalExtension();
      $file = $filename.'.'.$ext;



      
      
     
      Input::file('allowances')->move($destination, $file);


  


  Excel::selectSheetsByIndex(0)->load(public_path().'/migrations/'.$file, function($reader){

    $results = $reader->get();    
  
    foreach ($results as $result) {

    $name = explode(':', $result->employee);

    

    
    $employeeid = DB::table('employee')->where('personal_file_number', '=', $name[0])->pluck('id');

    $allowanceid = DB::table('allowances')->where('allowance_name', '=', $result->allowance_type)->pluck('id');

    $allowance = new EAllowances;

    $allowance->employee_id = $employeeid;

    $allowance->allowance_id = $allowanceid;

    $allowance->allowance_amount = $result->amount;

    $allowance->save();

    
      
    }
    

    

  });



      
    }



  return Redirect::back()->with('notice', 'allowances have been succefully imported');



  

});


/* #################### IMPORT DEDUCTIONS ################################## */

Route::post('import/deductions', function(){

  
  if(Input::hasFile('deductions')){

      $destination = public_path().'/migrations/';

      $filename = str_random(12);

      $ext = Input::file('deductions')->getClientOriginalExtension();
      $file = $filename.'.'.$ext;



      
      
     
      Input::file('deductions')->move($destination, $file);


  


  Excel::selectSheetsByIndex(0)->load(public_path().'/migrations/'.$file, function($reader){

    $results = $reader->get();    
  
    foreach ($results as $result) {

    $name = explode(':', $result->employee);

    

    
    $employeeid = DB::table('employee')->where('personal_file_number', '=', $name[0])->pluck('id');

    $deductionid = DB::table('deductions')->where('deduction_name', '=', $result->deduction_type)->pluck('id');

    $deduction = new EDeduction;

    $deduction->employee_id = $employeeid;

    $deduction->deduction_id = $deductionid;

    $deduction->deduction_amount = $result->amount;

    $deduction->deduction_date = $result->date;

    $deduction->save();

    
      
    }
    

    

  });



      
    }



  return Redirect::back()->with('notice', 'deductions have been succefully imported');



  

});



/* #################### IMPORT BANK BRANCHES ################################## */

Route::post('import/bankBranches', function(){

  
  if(Input::hasFile('bbranches')){

      $destination = public_path().'/migrations/';

      $filename = str_random(12);

      $ext = Input::file('bbranches')->getClientOriginalExtension();
      $file = $filename.'.'.$ext;



      
      
     
      Input::file('bbranches')->move($destination, $file);


  


  Excel::selectSheetsByIndex(0)->load(public_path().'/migrations/'.$file, function($reader){

    $results = $reader->get();    
  
    foreach ($results as $result) {
  

    $bbranch = new BBranch;

    $bbranch->branch_code = $result->branch_code;

    $bbranch->bank_branch_name = $result->branch_name;

    $bbranch->bank_id = $result->bank_id;

    $bbranch->organization_id = $result->organization_id;

    $bbranch->save();
      
    }   

  });
      
    }


  return Redirect::back()->with('notice', 'bank branches have been succefully imported');



  

});

/* #################### IMPORT BANKS ################################## */

Route::post('import/banks', function(){

  
  if(Input::hasFile('banks')){

      $destination = public_path().'/migrations/';

      $filename = str_random(12);

      $ext = Input::file('banks')->getClientOriginalExtension();
      $file = $filename.'.'.$ext;



      
      
     
      Input::file('banks')->move($destination, $file);


  


  Excel::selectSheetsByIndex(0)->load(public_path().'/migrations/'.$file, function($reader){

    $results = $reader->get();    
  
    foreach ($results as $result) {
  

    $bank = new Bank;

    $bank->bank_name = $result->bank_name;

    $bank->organization_id = $result->organization_id;

    $bank->save();
      
    }   

  });
      
    }


  return Redirect::back()->with('notice', 'banks have been succefully imported');



  

});



/*
* #####################################################################################################################
*/
/*
* banks routes
*/

Route::resource('banks', 'BanksController');
Route::post('banks/update/{id}', 'BanksController@update');
Route::get('banks/delete/{id}', 'BanksController@destroy');
Route::get('banks/edit/{id}', 'BanksController@edit');

/*
* departments routes
*/

Route::resource('departments', 'DepartmentsController');
Route::post('departments/update/{id}', 'DepartmentsController@update');
Route::get('departments/delete/{id}', 'DepartmentsController@destroy');
Route::get('departments/edit/{id}', 'DepartmentsController@edit');


/*
* bank branch routes
*/

Route::resource('bank_branch', 'BankBranchController');
Route::post('bank_branch/update/{id}', 'BankBranchController@update');
Route::get('bank_branch/delete/{id}', 'BankBranchController@destroy');
Route::get('bank_branch/edit/{id}', 'BankBranchController@edit');

/*
* allowances routes
*/

Route::resource('allowances', 'AllowancesController');
Route::post('allowances/update/{id}', 'AllowancesController@update');
Route::get('allowances/delete/{id}', 'AllowancesController@destroy');
Route::get('allowances/edit/{id}', 'AllowancesController@edit');

/*
* reliefs routes
*/

Route::resource('reliefs', 'ReliefsController');
Route::post('reliefs/update/{id}', 'ReliefsController@update');
Route::get('reliefs/delete/{id}', 'ReliefsController@destroy');
Route::get('reliefs/edit/{id}', 'ReliefsController@edit');

/*
* deductions routes
*/

Route::resource('deductions', 'DeductionsController');
Route::post('deductions/update/{id}', 'DeductionsController@update');
Route::get('deductions/delete/{id}', 'DeductionsController@destroy');
Route::get('deductions/edit/{id}', 'DeductionsController@edit');

/*
* nssf routes
*/

Route::resource('nssf', 'NssfController');
Route::post('nssf/update/{id}', 'NssfController@update');
Route::get('nssf/delete/{id}', 'NssfController@destroy');
Route::get('nssf/edit/{id}', 'NssfController@edit');

/*
* nhif routes
*/

Route::resource('nhif', 'NhifController');
Route::post('nhif/update/{id}', 'NhifController@update');
Route::get('nhif/delete/{id}', 'NhifController@destroy');
Route::get('nhif/edit/{id}', 'NhifController@edit');

/*
* job group routes
*/

Route::resource('job_group', 'JobGroupController');
Route::post('job_group/update/{id}', 'JobGroupController@update');
Route::get('job_group/delete/{id}', 'JobGroupController@destroy');
Route::get('job_group/edit/{id}', 'JobGroupController@edit');

/*
* employee type routes
*/

Route::resource('employee_type', 'EmployeeTypeController');
Route::post('employee_type/update/{id}', 'EmployeeTypeController@update');
Route::get('employee_type/delete/{id}', 'EmployeeTypeController@destroy');
Route::get('employee_type/edit/{id}', 'EmployeeTypeController@edit');

/*
* employees routes
*/

Route::resource('employees', 'EmployeesController');
Route::post('employees/update/{id}', 'EmployeesController@update');
Route::get('employees/delete/{id}', 'EmployeesController@destroy');
Route::get('employees/edit/{id}', 'EmployeesController@edit');

/*
* occurences routes
*/

Route::resource('occurences', 'OccurencesController');
Route::post('occurences/update/{id}', 'OccurencesController@update');
Route::get('occurences/delete/{id}', 'OccurencesController@destroy');
Route::get('occurences/edit/{id}', 'OccurencesController@edit');


/*
* employee earnings routes
*/

Route::resource('other_earnings', 'EarningsController');
Route::post('other_earnings/update/{id}', 'EarningsController@update');
Route::get('other_earnings/delete/{id}', 'EarningsController@destroy');
Route::get('other_earnings/edit/{id}', 'EarningsController@edit');

/*
* employee reliefs routes
*/

Route::resource('employee_relief', 'EmployeeReliefController');
Route::post('employee_relief/update/{id}', 'EmployeeReliefController@update');
Route::get('employee_relief/delete/{id}', 'EmployeeReliefController@destroy');
Route::get('employee_relief/edit/{id}', 'EmployeeReliefController@edit');

/*
* employee allowances routes
*/

Route::resource('employee_allowances', 'EmployeeAllowancesController');
Route::post('employee_allowances/update/{id}', 'EmployeeAllowancesController@update');
Route::get('employee_allowances/delete/{id}', 'EmployeeAllowancesController@destroy');
Route::get('employee_allowances/edit/{id}', 'EmployeeAllowancesController@edit');

/*
* employee deductions routes
*/

Route::resource('employee_deductions', 'EmployeeDeductionsController');
Route::post('employee_deductions/update/{id}', 'EmployeeDeductionsController@update');
Route::get('employee_deductions/delete/{id}', 'EmployeeDeductionsController@destroy');
Route::get('employee_deductions/edit/{id}', 'EmployeeDeductionsController@edit');

/*
* payroll routes
*/


Route::resource('payroll', 'PayrollController');
Route::post('deleterow', 'PayrollController@del_exist');
Route::post('payroll/preview', 'PayrollController@create');


/*
* employees routes
*/
Route::resource('employees', 'EmployeesController');
Route::get('employees/show/{id}', 'EmployeesController@show');
Route::group(['before' => 'create_employee'], function() {
Route::get('employees/create', 'EmployeesController@create');
});
Route::get('employees/edit/{id}', 'EmployeesController@edit');
Route::post('employees/update/{id}', 'EmployeesController@update');
Route::get('employees/delete/{id}', 'EmployeesController@destroy');





Route::get('payrollReports', function(){

    return View::make('employees.payrollreports');
});

Route::get('statutoryReports', function(){

    return View::make('employees.statutoryreports');
});

Route::get('email/payslip', 'payslipEmailController@index');
Route::post('email/payslip/employees', 'payslipEmailController@sendEmail');

Route::get('reports/employees', function(){

    return View::make('employees.reports');
});

Route::get('reports/employeelist', 'ReportsController@employees');
Route::get('employee/select', 'ReportsController@emp_id');
Route::post('reports/employee', 'ReportsController@individual');
Route::get('payrollReports/selectPeriod', 'ReportsController@period_payslip');
Route::post('payrollReports/payslip', 'ReportsController@payslip');
Route::get('payrollReports/selectAllowance', 'ReportsController@employee_allowances');
Route::post('payrollReports/allowances', 'ReportsController@allowances');
Route::get('payrollReports/selectDeduction', 'ReportsController@employee_deductions');
Route::post('payrollReports/deductions', 'ReportsController@deductions');
Route::get('payrollReports/selectPayePeriod', 'ReportsController@period_paye');
Route::post('payrollReports/payeReturns', 'ReportsController@payeReturns');
Route::get('payrollReports/selectRemittancePeriod', 'ReportsController@period_rem');
Route::post('payrollReports/payRemittances', 'ReportsController@payeRems');
Route::get('payrollReports/selectSummaryPeriod', 'ReportsController@period_summary');
Route::post('payrollReports/payrollSummary', 'ReportsController@paySummary');
Route::get('payrollReports/selectNssfPeriod', 'ReportsController@period_nssf');
Route::post('payrollReports/nssfReturns', 'ReportsController@nssfReturns');
Route::get('payrollReports/selectNhifPeriod', 'ReportsController@period_nhif');
Route::post('payrollReports/nhifReturns', 'ReportsController@nhifReturns');
Route::get('payrollReports/selectNssfExcelPeriod', 'ReportsController@period_excel');
Route::post('payrollReports/nssfExcel', 'ReportsController@export');
Route::get('reports/selectEmployeeOccurence', 'ReportsController@selEmp');
Route::post('reports/occurence', 'ReportsController@occurence');


/*
*#################################################################
*/
Route::group(['before' => 'process_payroll'], function() {

    


Route::get('payrollmgmt', function(){

     $employees = Employee::all();

  return View::make('payrollmgmt', compact('employees'));

});

});

Route::group(['before' => 'leave_mgmt'], function() {

Route::get('leavemgmt', function(){

  $leaveapplications = Leaveapplication::all();

  return View::make('leavemgmt', compact('leaveapplications'));

});

});


Route::get('erpmgmt', function(){

  return View::make('erpmgmt');

});



Route::get('cbsmgmt', function(){


      if(Confide::user()->user_type == 'admin'){

            $members = Member::all();

            //print_r($members);

            return View::make('cbsmgmt', compact('members'));

        } 

        if(Confide::user()->user_type == 'teller'){

            $members = Member::all();

            return View::make('tellers.dashboard', compact('members'));

        } 


        if(Confide::user()->user_type == 'member'){

            $loans = Loanproduct::all();
            $products = Product::all();

            $rproducts = Product::getRemoteProducts();

            
            return View::make('shop.index', compact('loans', 'products', 'rproducts'));

        } 


  



});





/*
* #####################################################################################################################
*/









Route::get('import', function(){

    return View::make('import');
});


Route::get('automated/loans', function(){

    
    $loanproducts = Loanproduct::all();

    return View::make('autoloans', compact('loanproducts'));
});

Route::get('automated/savings', function(){

    
   $savingproducts = Savingproduct::all();

    return View::make('automated', compact('savingproducts'));
});



Route::post('automated', function(){

    $members = DB::table('members')->where('is_active', '=', true)->get();


    $category = Input::get('category');


    
    
    if($category == 'savings'){

        $savingproduct_id = Input::get('savingproduct');

        $savingproduct = Savingproduct::findOrFail($savingproduct_id);

        

            foreach($savingproduct->savingaccounts as $savingaccount){

                if(($savingaccount->member->is_active) && (Savingaccount::getLastAmount($savingaccount) > 0)){

                    
                    $data = array(
                        'account_id' => $savingaccount->id,
                        'amount' => Savingaccount::getLastAmount($savingaccount), 
                        'date' => date('Y-m-d'),
                        'type'=>'credit'
                        );

                    Savingtransaction::creditAccounts($data);
                    

                    

                }
 
                

            

    }

       Autoprocess::record(date('Y-m-d'), 'saving', $savingproduct); 
      

        

    } else {

        $loanproduct_id = Input::get('loanproduct');

        $loanproduct = Loanproduct::findOrFail($loanproduct_id);


        

        

            foreach($loanproduct->loanaccounts as $loanaccount){

                if(($loanaccount->member->is_active) && (Loanaccount::getEMP($loanaccount) > 0)){

                    
                    
                    $data = array(
                        'loanaccount_id' => $loanaccount->id,
                        'amount' => Loanaccount::getEMP($loanaccount), 
                        'date' => date('Y-m-d')
                        
                        );


                    Loanrepayment::repayLoan($data);
                    

                    
                   

                    

                }
            }


             Autoprocess::record(date('Y-m-d'), 'loan', $loanproduct);
            

    }


    

    return Redirect::back()->with('notice', 'successfully processed');
    

    
});






Route::get('loanrepayments/offprint/{id}', 'LoanrepaymentsController@offprint');



Route::resource('members', 'MembersController');
Route::post('members/update/{id}', 'MembersController@update');
Route::get('members/delete/{id}', 'MembersController@destroy');
Route::get('members/edit/{id}', 'MembersController@edit');

Route::get('members/show/{id}', 'MembersController@show');
Route::get('members/loanaccounts/{id}', 'MembersController@loanaccounts');
Route::get('memberloans', 'MembersController@loanaccounts2');
Route::group(['before' => 'limit'], function() {

    Route::get('members/create', 'MembersController@create');
});

Route::resource('kins', 'KinsController');
Route::post('kins/update/{id}', 'KinsController@update');
Route::get('kins/delete/{id}', 'KinsController@destroy');
Route::get('kins/edit/{id}', 'KinsController@edit');
Route::get('kins/show/{id}', 'KinsController@show');
Route::get('kins/create/{id}', 'KinsController@create');





Route::resource('charges', 'ChargesController');
Route::post('charges/update/{id}', 'ChargesController@update');
Route::get('charges/delete/{id}', 'ChargesController@destroy');
Route::get('charges/edit/{id}', 'ChargesController@edit');
Route::get('charges/show/{id}', 'ChargesController@show');
Route::get('charges/disable/{id}', 'ChargesController@disable');
Route::get('charges/enable/{id}', 'ChargesController@enable');

Route::resource('savingproducts', 'SavingproductsController');
Route::post('savingproducts/update/{id}', 'SavingproductsController@update');
Route::get('savingproducts/delete/{id}', 'SavingproductsController@destroy');
Route::get('savingproducts/edit/{id}', 'SavingproductsController@edit');
Route::get('savingproducts/show/{id}', 'SavingproductsController@show');




Route::resource('savingaccounts', 'SavingaccountsController');
Route::get('savingaccounts/create/{id}', 'SavingaccountsController@create');
Route::get('member/savingaccounts/{id}', 'SavingaccountsController@memberaccounts');



Route::get('savingtransactions/show/{id}', 'SavingtransactionsController@show');
Route::resource('savingtransactions', 'SavingtransactionsController');
Route::get('savingtransactions/create/{id}', 'SavingtransactionsController@create');
Route::get('savingtransactions/receipt/{id}', 'SavingtransactionsController@receipt');
Route::get('savingtransactions/statement/{id}', 'SavingtransactionsController@statement');

Route::post('savingtransactions/import', 'SavingtransactionsController@import');

//Route::resource('savingpostings', 'SavingpostingsController');



Route::resource('shares', 'SharesController');
Route::post('shares/update/{id}', 'SharesController@update');
Route::get('shares/delete/{id}', 'SharesController@destroy');
Route::get('shares/edit/{id}', 'SharesController@edit');
Route::get('shares/show/{id}', 'SharesController@show');



Route::get('sharetransactions/show/{id}', 'SharetransactionsController@show');
Route::resource('sharetransactions', 'SharetransactionsController');
Route::get('sharetransactions/create/{id}', 'SharetransactionsController@create');





Route::post('license/key', 'OrganizationsController@generate_license_key');
Route::post('license/activate', 'OrganizationsController@activate_license');
Route::get('license/activate/{id}', 'OrganizationsController@activate_license_form');



Route::resource('loanproducts', 'LoanproductsController');
Route::post('loanproducts/update/{id}', 'LoanproductsController@update');
Route::get('loanproducts/delete/{id}', 'LoanproductsController@destroy');
Route::get('loanproducts/edit/{id}', 'LoanproductsController@edit');
Route::get('loanproducts/show/{id}', 'LoanproductsController@show');



Route::resource('loanguarantors', 'LoanguarantorsController');
Route::post('loanguarantors/update/{id}', 'LoanguarantorsController@update');
Route::get('loanguarantors/delete/{id}', 'LoanguarantorsController@destroy');
Route::get('loanguarantors/edit/{id}', 'LoanguarantorsController@edit');
Route::get('loanguarantors/create/{id}', 'LoanguarantorsController@create');
Route::get('loanguarantors/css/{id}', 'LoanguarantorsController@csscreate');

Route::post('loanguarantors/cssupdate/{id}', 'LoanguarantorsController@cssupdate');
Route::get('loanguarantors/cssdelete/{id}', 'LoanguarantorsController@cssdestroy');
Route::get('loanguarantors/cssedit/{id}', 'LoanguarantorsController@cssedit');



Route::resource('loans', 'LoanaccountsController');
Route::get('loans/apply/{id}', 'LoanaccountsController@apply');
Route::post('loans/apply', 'LoanaccountsController@doapply');
Route::post('loans/application', 'LoanaccountsController@doapply2');


Route::get('loantransactions/statement/{id}', 'LoantransactionsController@statement');
Route::get('loantransactions/receipt/{id}', 'LoantransactionsController@receipt');

Route::get('loans/application/{id}', 'LoanaccountsController@apply2');
Route::post('shopapplication', 'LoanaccountsController@shopapplication');

Route::get('loans/edit/{id}', 'LoanaccountsController@edit');
Route::post('loans/update/{id}', 'LoanaccountsController@update');

Route::get('loans/approve/{id}', 'LoanaccountsController@approve');
Route::post('loans/approve/{id}', 'LoanaccountsController@doapprove');


Route::get('loans/reject/{id}', 'LoanaccountsController@reject');
Route::post('loans/reject/{id}', 'LoanaccountsController@doreject');

Route::get('loans/disburse/{id}', 'LoanaccountsController@disburse');
Route::post('loans/disburse/{id}', 'LoanaccountsController@dodisburse');

Route::get('loans/show/{id}', 'LoanaccountsController@show');

Route::post('loans/amend/{id}', 'LoanaccountsController@amend');

Route::get('loans/reject/{id}', 'LoanaccountsController@reject');
Route::post('loans/reject/{id}', 'LoanaccountsController@rejectapplication');


Route::get('loanaccounts/topup/{id}', 'LoanaccountsController@gettopup');
Route::post('loanaccounts/topup/{id}', 'LoanaccountsController@topup');

Route::get('memloans/{id}', 'LoanaccountsController@show2');

Route::resource('loanrepayments', 'LoanrepaymentsController');

Route::get('loanrepayments/create/{id}', 'LoanrepaymentsController@create');
Route::get('loanrepayments/offset/{id}', 'LoanrepaymentsController@offset');
Route::post('loanrepayments/offsetloan', 'LoanrepaymentsController@offsetloan');





Route::get('reports', function(){

    return View::make('members.reports');
});

Route::get('reports/combined', function(){

    $members = Member::all();

    return View::make('members.combined', compact('members'));
});


Route::get('loanreports', function(){

    $loanproducts = Loanproduct::all();

    return View::make('loanaccounts.reports', compact('loanproducts'));
});


Route::get('savingreports', function(){

    $savingproducts = Savingproduct::all();

    return View::make('savingaccounts.reports', compact('savingproducts'));
});


Route::get('financialreports', function(){

    

    return View::make('pdf.financials.reports');
});



Route::get('reports/listing', 'ReportsController@members');
Route::get('reports/remittance', 'ReportsController@remittance');
Route::get('reports/blank', 'ReportsController@template');
Route::get('reports/loanlisting', 'ReportsController@loanlisting');

Route::get('reports/loanproduct/{id}', 'ReportsController@loanproduct');

Route::get('reports/savinglisting', 'ReportsController@savinglisting');

Route::get('reports/savingproduct/{id}', 'ReportsController@savingproduct');

Route::post('reports/financials', 'ReportsController@financials');



Route::get('portal', function(){

    //$members = DB::table('members')->where('is_active', '=', TRUE)->get();

  $employees = Employee::all();

    return View::make('css.employees', compact('employees'));
});

Route::get('portal/activate/{id}', 'MembersController@activateportal');
Route::get('portal/deactivate/{id}', 'MembersController@deactivateportal');
Route::get('css/reset/{id}', 'MembersController@reset');








/*
* Vendor controllers
*/
Route::resource('vendors', 'VendorsController');
Route::get('vendors/create', 'VendorsController@create');
Route::post('vendors/update/{id}', 'VendorsController@update');
Route::get('vendors/edit/{id}', 'VendorsController@edit');
Route::get('vendors/delete/{id}', 'VendorsController@destroy');
Route::get('vendors/products/{id}', 'VendorsController@products');
Route::get('vendors/orders/{id}', 'VendorsController@orders');

/*
* products controllers
*/
Route::resource('products', 'ProductsController');
Route::post('products/update/{id}', 'ProductsController@update');
Route::get('products/edit/{id}', 'ProductsController@edit');
Route::get('products/create', 'ProductsController@create');
Route::get('products/delete/{id}', 'ProductsController@destroy');
Route::get('products/orders/{id}', 'ProductsController@orders');
Route::get('shop', 'ProductsController@shop');

/*
* orders controllers
*/
Route::resource('orders', 'OrdersController');
Route::post('orders/update/{id}', 'OrdersControler@update');
Route::get('orders/edit/{id}', 'OrdersControler@edit');
Route::get('orders/delete/{id}', 'OrdersControler@destroy');




Route::get('savings', function(){

    $mem = Confide::user()->username;

   

    $memb = DB::table('members')->where('membership_no', '=', $mem)->pluck('id');

    $member = Member::find($memb);

    
    

    return View::make('css.savingaccounts', compact('member'));
});


Route::post('loanguarantors', function(){

    
    $mem_id = Input::get('member_id');

        $member = Member::findOrFail($mem_id);

        $loanaccount = Loanaccount::findOrFail(Input::get('loanaccount_id'));


        $guarantor = new Loanguarantor;

        $guarantor->member()->associate($member);
        $guarantor->loanaccount()->associate($loanaccount);
        $guarantor->amount = Input::get('amount');
        $guarantor->save();
        


        return Redirect::to('memloans/'.$loanaccount->id);

});




Route::get('backups', function(){

   
    //$backups = Backup::getRestorationFiles('../app/storage/backup/');

    return View::make('backup');

});


Route::get('backups/create', function(){

    echo '<pre>';

    $instance = Backup::getBackupEngineInstance();

    print_r($instance);

    //Backup::setPath(public_path().'/backups/');

   //Backup::export();
    //$backups = Backup::getRestorationFiles('../app/storage/backup/');

    //return View::make('backup');

});


Route::get('memtransactions/{id}', 'MembersController@savingtransactions');


/*
* This route is for testing how license conversion works. its purely for testing purposes
*/
Route::get('convert', function(){




// get the name of the organization from the database
//$org_id = Confide::user()->organization_id;

$organization = Organization::findorfail(1);



$string =  $organization->name;

echo "Organization: ". $string."<br>";


$organization = new Organization;






$license_code = $organization->encode($string);

echo "License Code: ".$license_code."<br>";


$name2 = $organization->decode($license_code, 7);

echo "Decoded L code: ".$name2."<br>";





$license_key = $organization->license_key_generator($license_code);

echo "License Key: ".$license_key."<br>";

echo "__________________________________________________<br>";

$name4 = $organization->license_key_validator($license_key,$license_code,$string);

echo "Decoded L code: ".$name4."<br>";



});




/* ########################  ERP ROUTES ################################ */

Route::resource('clients', 'ClientsController');
Route::get('clients/edit/{id}', 'ClientsController@edit');
Route::post('clients/update/{id}', 'ClientsController@update');
Route::get('clients/delete/{id}', 'ClientsController@destroy');

Route::resource('items', 'ItemsController');
Route::get('items/edit/{id}', 'ItemsController@edit');
Route::post('items/update/{id}', 'ItemsController@update');
Route::get('items/delete/{id}', 'ItemsController@destroy');


Route::resource('paymentmethods', 'PaymentmethodsController');


Route::resource('locations', 'LocationsController');
Route::get('locations/edit/{id}', 'LocationsController@edit');
Route::get('locations/delete/{id}', 'LocationsController@destroy');
Route::post('locations/update/{id}', 'LocationsController@update');



Route::resource('expenses', 'ExpensesController');



Route::resource('payments', 'PaymentsController');





/*
Leave Reports
*/

Route::get('leaveReports', function(){

    return View::make('leavereports.leavereports');
});

Route::get('leaveReports/selectApplicationPeriod', 'ReportsController@appperiod');
Route::post('leaveReports/leaveapplications', 'ReportsController@leaveapplications');

Route::get('leaveReports/selectApprovedPeriod', 'ReportsController@approvedperiod');
Route::post('leaveReports/approvedleaves', 'ReportsController@approvedleaves');

Route::get('leaveReports/selectRejectedPeriod', 'ReportsController@rejectedperiod');
Route::post('leaveReports/rejectedleaves', 'ReportsController@rejectedleaves');

Route::get('leaveReports/selectLeave', 'ReportsController@balanceselect');
Route::post('leaveReports/leaveBalances', 'ReportsController@leavebalances');

Route::get('leaveReports/selectLeaveType', 'ReportsController@leaveselect');
Route::post('leaveReports/Employeesonleave', 'ReportsController@employeesleave');

Route::get('leaveReports/selectEmployee', 'ReportsController@employeeselect');
Route::post('leaveReports/IndividualEmployeeLeave', 'ReportsController@individualleave');

Route::get('api/dropdown', function(){
    $id = Input::get('option');
    $bbranch = Bank::find($id)->bankbranch;
    return $bbranch->lists('bank_branch_name', 'id');
});


Route::get('empedit/{id}', function($id){

  

  $employee = Employee::find($id);
    $branches = Branch::all();
    $departments = Department::all();
    $jgroups = JGroup::all();
    $etypes = EType::all();
    $banks = Bank::all();
    $bbranches = BBranch::all();
    return View::make('employees.cssedit', compact('branches','departments','etypes','jgroups','banks','bbranches','employee'));
  
});



Route::get('css/payslips', function(){

  $employeeid = DB::table('employee')->where('personal_file_number', '=', Confide::user()->username)->pluck('id');

  $employee = Employee::findorfail($employeeid);

  return View::make('css.payslip', compact('employee'));
});


Route::get('css/leave', function(){

  $employeeid = DB::table('employee')->where('personal_file_number', '=', Confide::user()->username)->pluck('id');


  $employee = Employee::findorfail($employeeid);

   $leaveapplications = DB::table('leaveapplications')->where('employee_id', '=', $employee->id)->get();

  return View::make('css.leave', compact('employee', 'leaveapplications'));
});


Route::get('css/leaveapply', function(){

  $employeeid = DB::table('employee')->where('personal_file_number', '=', Confide::user()->username)->pluck('id');

  $employee = Employee::findorfail($employeeid);
  $leavetypes = Leavetype::all();

  return View::make('css.leaveapply', compact('employee', 'leavetypes'));
});


Route::get('css/balances', function(){

  $employeeid = DB::table('employee')->where('personal_file_number', '=', Confide::user()->username)->pluck('id');

  $employee = Employee::findorfail($employeeid);
  $leavetypes = Leavetype::all();

  return View::make('css.balances', compact('employee', 'leavetypes'));
});



/*
*##########################ERP REPORTS#######################################
*/

Route::get('erpReports', function(){

    return View::make('erpreports.erpReports');
});

Route::get('erpReports/clients', 'ErpReportsController@clients');
Route::get('erpReports/items', 'ErpReportsController@items');
Route::get('erpReports/expenses', 'ErpReportsController@expenses');
Route::get('erpReports/paymentmethods', 'ErpReportsController@paymentmethods');
Route::get('erpReports/payments', 'ErpReportsController@payments');

Route::get('erpReports/locations', 'ErpReportsController@locations');
Route::get('erpReports/stock', 'ErpReportsController@stock');






Route::get('salesorders', function(){

  $orders = Erporder::all();
  $items = Item::all();
  $locations = Location::all();

  return View::make('erporders.index', compact('items', 'locations', 'orders'));
});



Route::get('salesorders/create', function(){

  $order_number = rand(100,100000);
  $items = Item::all();
  $locations = Location::all();

  $clients = Client::all();

  return View::make('erporders.create', compact('items', 'locations', 'order_number', 'clients'));
});

Route::post('erporders/create', function(){

  $data = Input::all();

  $client = Client::findOrFail(array_get($data, 'client'));

/*
  $erporder = array(
    'order_number' => array_get($data, 'order_number'), 
    'client' => $client,
    'date' => array_get($data, 'date')

    );
  */

  Session::put( 'erporder', array(
    'order_number' => array_get($data, 'order_number'), 
    'client' => $client,
    'date' => array_get($data, 'date')

    )
    );
  Session::put('orderitems', []);

  $orderitems =Session::get('orderitems');

 /*
  $erporder = new Erporder;

  $erporder->date = date('Y-m-d', strtotime(array_get($data, 'date')));
  $erporder->order_number = array_get($data, 'order_number');
  $erporder->client()->associate($client);
  $erporder->payment_type = array_get($data, 'payment_type');
  $erporder->type = 'sales';
  $erporder->save();

  */

  $items = Item::all();
  $locations = Location::all();


  return View::make('erporders.orderitems', compact('erporder', 'items', 'locations', 'orderitems'));

});


Route::post('orderitems/create', function(){

  $data = Input::all();

  $item = Item::findOrFail(array_get($data, 'item'));

  $item_name = $item->name;
  $price = $item->selling_price;
  $quantity = Input::get('quantity');
  $duration = Input::get('duration');
  $item_id = $item->id;

  

   Session::push('orderitems', [
      'itemid' => $item_id,
      'item' => $item_name,
      'price' => $price,
      'quantity' => $quantity,
      'duration' => $duration

    ]);

  $orderitems = Session::get('orderitems');

   $items = Item::all();
  $locations = Location::all();

  return View::make('erporders.orderitems', compact('items', 'locations', 'orderitems'));

});


Route::get('orderitems/remove/{id}', function($id){

   
     $orderitems = Session::get('orderitems');

     foreach ($orderitems as $orderitem) {
       if($orderitem['itemid'] == $id){
          //Session::forget($orderitem);
        
  //Session::forget('orderitems', $id);
       }
     }




 $orderitems = Session::get('orderitems');


  $items = Item::all();
  $locations = Location::all();

  return View::make('erporders.orderitems', compact('items', 'locations', 'orderitems'));

});


Route::resource('stocks', 'StocksController');


Route::get('erporder/commit', function(){

  $erporder = Session::get('erporder');

  $erporderitems = Session::get('orderitems');

 // $client = Client::findorfail(array_get($erporder, 'client'));

  //print_r($erporder);


  $order = new Erporder;
  $order->order_number = array_get($erporder, 'order_number');
  $order->client()->associate(array_get($erporder, 'client'));
  $order->date = date('Y-m-d', strtotime(array_get($erporder, 'date')));
  $order->status = 'new';
  $order->type = 'sales';
  $order->save();
  

  foreach($erporderitems as $item){


    $itm = Item::findOrFail($item['itemid']);

    $ord = Erporder::findOrFail($order->id);

    $orderitem = new Erporderitem;
    $orderitem->erporder()->associate($ord);
    $orderitem->item()->associate($itm);
    $orderitem->price = $item['price'];
    $orderitem->quantity = $item['quantity'];
    $orderitem->duration = $item['duration'];
    $orderitem->save();
  }

//Session::purge('orderitems');
//Session::purge('erporder');
return Redirect::to('salesorders');



});


Route::get('erporders/cancel/{id}', function($id){

  $order = Erporder::findorfail($id);



  $order->status = 'cancelled';
  $order->update();

  return Redirect::to('salesorders');
  
});


Route::get('erporders/show/{id}', function($id){

  $order = Erporder::findorfail($id);

  return View::make('erporders.show', compact('order'));
  
});





