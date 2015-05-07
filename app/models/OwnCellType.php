<?php

class OwnCellType extends Eloquent {
	protected $fillable = array('name','type');

	public function cells()
	{
		return $this->hasMany('OwnCell');
	}
}