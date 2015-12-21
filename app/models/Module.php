<?php

class Module extends Eloquent {

	protected $fillable = array('name', 'key');

	public function settings()
	{
		return $this->hasMany('Setting');
	}
	public function setting_values()
	{
		return $this->hasManyThrough("SettingValue", "Setting");
	}
}