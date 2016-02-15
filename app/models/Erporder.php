<?php

class Erporder extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];


	public function paymentmethod(){

		return $this->belongsTo('Paymentmethod');
	}

	public function client(){

		return $this->belongsTo('Client');
	}

	public function erporderitems(){

		return $this->hasMany('Erporderitem');
	}

	public function payments(){

		return $this->hasMany('Payment');
	}

	

}