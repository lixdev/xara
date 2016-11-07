<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;
use Zizaco\Entrust\HasRole;

class User extends Eloquent implements ConfideUserInterface {

	use ConfideUser, HasRole;

	

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	/**
	* validation rules
	*
	*/
	public static $rules = [
            'username' => 'required|alpha_dash',
            'email'    => 'required|email',
            'password' => 'required|min:4|confirmed',
        
    ];


    public static function exists($employee){

    	$exists = DB::table('users')->where('organization_id',Confide::user()->organization_id)->where('username', '=', $employee->personal_file_number)->count();

    	if($exists >= 1){
    		return true;
    	}
    	else{
    		return false;
    	}
    }

    


}
