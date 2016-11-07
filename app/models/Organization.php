<?php

class Organization extends \Eloquent {

	/*

	use \Traits\Encryptable;


	protected $encryptable = [
		'name',
		'email',
		'website',
		'address',
		'phone',
		'kra_pin',
		'nssf_no',
		'nhif_no',
		'license_type',	
	];

	*/

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];



public function holidays(){

	return $this->hasMany('Holiday');
}


public function leavetypes(){

	return $this->hasMany('Leavetype');
}

public function leaveapplications(){

	return $this->hasMany('Leaveapplication');
}


public static function getOrganizationName(){

	$organization_id = Confide::user()->organization_id;

	$organization = Organization::find($organization_id);

	return $organization->name;

}

public static function getActive(){

	$organization_id = Confide::user()->organization_id;

	$organization = Organization::find($organization_id);

	return $organization;

}


public static function getUserOrganization(){

	$organization_id = Confide::user()->organization_id;

	$organization = Organization::find($organization_id);

	return $organization;
}

public static function createKey($string){
$key = "#&sdfdfs789fs7d";
$encoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
return $encoded;
}

public static function decodeKey($string){
$key = "#&sdfdfs789fs7d";
$decoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
return $decoded;
}

public static function binToStr($input)
{
    if (!is_string($input))
        return false;
    $chunks = str_split($input,8);
    $ret = '';
    foreach ($chunks as $chunk)
    {
        $ret .= chr(bindec($chunk));
    }
    return $ret;
}
 
public static function strToBin($input)
{
    if (!is_string($input))
        return false;
    $ret = '';
    for ($i = 0; $i < strlen($input); $i++)
    {
        $temp = decbin(ord($input{$i}));
        $ret .= str_repeat("0", 8 - strlen($temp)) . $temp;
    }
    return $ret;
}

public function encode($string){


$keycode = 7;


//upper case everything
$string = strtoupper($string);



//Convert whitespaces and underscore to dash
$string = preg_replace("/[\s_]/", "P", $string);

// alphabetic keys
$alphabets = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

$alphabets = str_split($alphabets);


// organization name characters
$chars = str_split($string);



// store the codes
$code = array();

foreach($chars as $char){

    // find and return the coresspomding number from the alphabet
    $key = array_search($char, $alphabets);

    // add the key value to the key code value
    $codeval = $key + $keycode;


    if($codeval > 25){

    	$co = $codeval - 25;
        $code[]  = $alphabets[$co];
  
    }
    else {

         $code[]  = $alphabets[$codeval];
    }
    

}




$code = implode('', $code);


$result = substr($code, 0, 4);


// encode PAYE

$encoded = strtoupper($this->unique_id(3)).''.$result.''.strtoupper($this->unique_id(3));

return $encoded;








}



public static function decode($string, $keycode){




$first_part = substr($string, 0, 3);
$last_part = substr($string, 7, 3);

//upper case everything
$string = strtoupper(substr($string, 0, 4));




// alphabetic keys
$alphabets = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

$alphabets = str_split($alphabets);


// organization name characters
$chars = str_split($string);



// store the codes
$code = array();

foreach($chars as $char){

    // find and return the coresspomding number from the alphabet
    $key = array_search($char, $alphabets);

    // add the key value to the key code value
    $codeval = $key - $keycode;

 
   if($codeval < 0){

    	$co = $codeval + 25;
        $code[]  = $alphabets[$co];
  
    }
    else {

         $code[]  = $alphabets[$codeval];
    }

 
    
    

}




$code = implode('', $code);



return $code;








}





public function unique_id($l) {
    return substr(md5(uniqid(mt_rand(), true)), 0, $l);
}



function generateRandomString($length = 10) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}


public function license_key_generator($license_code){

	//keycode
	$keycode = 7;

	//get the name part
	$org_name = substr($license_code, 3, 4);
	$first_part = substr($license_code, 0, 3);
	$last_part = substr($license_code, 7, 3);


	//convert the name to its equivalent numbers

	// alphabetic keys
	$alphabets = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

	$alphabets = str_split($alphabets);


	// organization name characters
	$chars = str_split($org_name);



	// store the codes
	$license_key = array();

	foreach($chars as $char){

    	// find and return the coresspomding number from the alphabet
    	$key = array_search($char, $alphabets);

    	// add the key value to the key code value
    	$codeval = $key - $keycode;

 
   		if($codeval < 0){

    		$co = $codeval + 25;
        	$license_key[]  = $alphabets[$co];
  
    	}
    	else {

         	$license_key[]  = $alphabets[$codeval];
    	}


	}

	$license_key = implode('', $license_key);

	//encode license_name with a different keycode
	$chars = str_split($license_key);

	$license_key = array();
	$keycode = 5;

	foreach($chars as $char){

    	// find and return the coresspomding number from the alphabet
    	$key = array_search($char, $alphabets);

    	// add the key value to the key code value
    	$codeval = $key + $keycode;

 
   		if($codeval > 25){

    		$co = $codeval - 25;
        	$license_key[]  = $alphabets[$co];
  
    	}

    	else {

         	$license_key[]  = $alphabets[$codeval];
    	}


	}






	$license_key = implode('', $license_key);

	$license_key = $license_key.''.$last_part.''.$first_part;

	return $license_key;



}



public function license_key_validator($license_key, $license_code, $org_name){


	// get the necessary parts
	$license_code = substr($license_code, 3, 4);
	$license_key  = substr($license_key, 0, 4);
	$org_name = strtoupper(substr($org_name, 0, 4));

	$license_code_name = $this->decode($license_code, '7');

	if($license_code_name == $org_name){

		
		$license_key_name = $this->decode($license_key, '5');

		if($license_key_name == $license_code_name){

			return true;
		} else {

			return false;
		}
	} else {

		return false;
	}




}








}