<?php

class Stock extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];


	public function location(){
		return $this->belongsTo('Location');
	}

	public function item(){
		return $this->belongsTo('Item');
	}
}