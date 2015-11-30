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

    if($count == 0 ){

        return View::make('signup');
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

            

            return View::make('dashboard');

        } 

        

      
        } else {
            return View::make('login');
        }
});
//

// Confide routes
Route::get('users/create', 'UsersController@create');
Route::get('users/edit/{user}', 'UsersController@edit');
Route::post('users/update/{user}', 'UsersController@update');
Route::post('users', 'UsersController@store');
Route::get('users/login', 'UsersController@login');
Route::post('users/login', 'UsersController@doLogin');
Route::get('users/confirm/{code}', 'UsersController@confirm');
Route::get('users/forgot_password', 'UsersController@forgotPassword');
Route::post('users/forgot_password', 'UsersController@doForgotPassword');
Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
Route::post('users/reset_password', 'UsersController@doResetPassword');
Route::get('users/logout', 'UsersController@logout');
Route::resource('users', 'UsersController');
Route::get('users/activate/{user}', 'UsersController@activate');
Route::get('users/deactivate/{user}', 'UsersController@deactivate');
Route::get('users/destroy/{user}', 'UsersController@destroy');
Route::get('users/password/{user}', 'UsersController@Password');
Route::post('users/password/{user}', 'UsersController@changePassword');
Route::get('users/profile/{user}', 'UsersController@profile');
Route::get('users/add', 'UsersController@add');
Route::post('users/newuser', 'UsersController@newuser');


Route::post('users/pass', 'UsersController@changePassword2');


Route::resource('roles', 'RolesController');
Route::get('roles/create', 'RolesController@create');
Route::get('roles/edit/{id}', 'RolesController@edit');
Route::post('roles/update/{id}', 'RolesController@update');
Route::get('roles/delete/{id}', 'RolesController@destroy');

Route::get('import', function(){

    return View::make('import');
});



Route::get('system', function(){


    $organization = Organization::find(1);

    return View::make('system.index', compact('organization'));
});



Route::get('license', function(){


    $organization = Organization::find(1);

    return View::make('system.license', compact('organization'));
});




/**
* Organization routes
*/
Route::resource('organizations', 'OrganizationsController');
Route::post('organizations/update/{id}', 'OrganizationsController@update');
Route::post('organizations/logo/{id}', 'OrganizationsController@logo');

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



Route::resource('branches', 'BranchesController');
Route::post('branches/update/{id}', 'BranchesController@update');
Route::get('branches/delete/{id}', 'BranchesController@destroy');
Route::get('branches/edit/{id}', 'BranchesController@edit');

/*
* groups routes
*/
Route::resource('groups', 'GroupsController');
Route::post('groups/update/{id}', 'GroupsController@update');
Route::get('groups/delete/{id}', 'GroupsController@destroy');
Route::get('groups/edit/{id}', 'GroupsController@edit');


/*
* accounts routes
*/
Route::resource('accounts', 'AccountsController');
Route::post('accounts/update/{id}', 'AccountsController@update');
Route::get('accounts/delete/{id}', 'AccountsController@destroy');
Route::get('accounts/edit/{id}', 'AccountsController@edit');
Route::get('accounts/show/{id}', 'AccountsController@show');
Route::get('accounts/create/{id}', 'AccountsController@create');



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

Route::resource('audits', 'AuditsController');


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
* Reports route. this will return the default report view
*/

Route::get('reports', function(){

   
    

    return View::make('reports');

});



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







