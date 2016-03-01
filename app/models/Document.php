<?php

class Document extends \Eloquent {
/*
	use \Traits\Encryptable;


	protected $encryptable = [

		'allowance_name',
	];
	*/

public static $rules = [
        'employee' => 'required',
		'type' => 'required',
		'path' => 'required'
	];

 public static function rolesUpdate()
    {
        return array(
        'employee' => 'required',
		'type' => 'required'
        );
    }

	public static $messsages = array(
        'employee.required'=>'Please select employee!',
        'type.required'=>'Please insert document type!',
        'path.required'=>'Please upload employee document!',
    );

	// Don't forget to fill this array
	protected $fillable = [];


	public function employee(){

		return $this->belongsTo('Employee');
	}

}