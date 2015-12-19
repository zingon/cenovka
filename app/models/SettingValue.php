<?php

class SettingValue extends Eloquent {
	protected $table = 'setting_user';
	protected $fillable = array('value');

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function setting()
	{
		return $this->belongsTo('Setting');
	}
}