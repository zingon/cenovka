<?php

class OwnCell extends Eloquent {
	protected $fillable = array('name','tight_name','default_value','poradi','use');

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function values()
	{
		return $this->hasMany('OwnCellValue');
	}
	public function type() {
		return $this->belongsTo('OwnCellType');
	}
}