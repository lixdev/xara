<?php

class Paymentmethod extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];


	public function account(){
		return $this->belongsTo('Account');
	}


	public function erporders(){

		return $this->hasMany('Erporder');
	}

}