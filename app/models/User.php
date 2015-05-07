<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function items() {
		return $this->hasMany('Item');
	}
	public function categories() {
		return $this->hasMany('Category');
	}
	public function documents() {
		return $this->hasMany('Document');
	}
	public function contacts() {
		return $this->hasMany('Contact');
	}
	public function cells() {
		return $this->hasMany('OwnCell');
	}


}
