<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Contact extends Eloquent {

	use SoftDeletingTrait;

	protected $fillable = array('name', 'firstname','lastname','city','zip_code','adress','ic','dic', 'note','email','phone');
	protected $dates = ['deleted_at'];

	public function documents() {
        return $this->hasMany('Document','odberatel_id');
    }

    public function user() {
    	return $this->belongsTo('User');
    }

     public function scopeRemoved($query) {
     	return $query->withTrashed()->first();
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