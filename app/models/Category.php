<?php

class Category extends Eloquent {

	protected $fillable = array('name','code' , 'note','class');

	public function items()
	{
		return $this->hasMany('Item');
	}

	public function user()
	{
		return $this->belongsTo("User");
	}

}