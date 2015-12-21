<?php

class Setting extends Eloquent {

	protected $fillable = array('key','name');

	public function setting_values()
	{
		return $this->hasMany('SettingValue');
	}
	public function module()
	{
		return $this->belongsTo('Module');
	}
}