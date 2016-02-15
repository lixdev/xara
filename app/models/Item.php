<?php

class Item extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	public function erporderitems(){

		return $this->belongsToMany('Erporderitem');
	}

	public function stocks(){

		return $this->hasMany('Stock');
	}

}