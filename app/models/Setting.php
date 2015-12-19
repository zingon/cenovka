<?php

class Setting extends Eloquent {

	protected $fillable = array('module','module_name', 'key','key_name');

	public function setting_values()
	{
		return $this->belongsTo('SettingValue');
	}
}