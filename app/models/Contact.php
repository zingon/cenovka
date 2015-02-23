<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Contact extends Eloquent {
	
	use SoftDeletingTrait;

	protected $fillable = array('name', 'firstname','lastname','city','zip_code','adress','ic','dic', 'note','email','phone');
	protected $dates = ['deleted_at'];

	public function documents() {
        return $this->hasMany('Document','dodatavel_id');
    }

     public function scopeRemoved($query) {
     	return $query->withTrashed()->first();
     }
}