<?php

class Property extends \Eloquent {
/*
	use \Traits\Encryptable;

	*/

	public static $rules = [
		'name' => 'required',
		'employee_id' => 'required',
		'amount' => 'required|regex:/^\d+(\.\d{2})?$/',
		'sdate' => 'required'
	];

	public static $messages = array(
		'employee_id.required'=>'Please select employee!',
        'name.required'=>'Please insert property name!',
        'amount.required'=>'Please insert property amount!',
        'amount.regex'=>'Please insert a valid amount!',
        'sdate.required'=>'Please select scheduled return date!',
    );

	// Don't forget to fill this array
	protected $fillable = [];

	public function employee(){

		return $this->belongsTo('Employee');
	}

}