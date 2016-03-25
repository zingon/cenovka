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