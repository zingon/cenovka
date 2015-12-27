<?php

class UserSetting extends Eloquent {

	protected $fillable = array('name', 'firstname','lastname','city','zip_code','adress','ic','dic', 'note','phone');

	public function user() {
		return $this->hasOne("User","id","user_id");
	}


	public function scopeFindOrCreate($query, $arrayOrId)
	{
		if(is_array($arrayOrId)) {
			foreach ($arrayOrId as $key => $value) {
				$query->where($key,"=",$value);
			}
			$obj = $query->first();
		} else {
			$obj = $query->find($id);
		}
	    return $obj ?: new static;
	}
}