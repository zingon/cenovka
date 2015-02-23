<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Item extends Eloquent {
	
	use SoftDeletingTrait;

	protected $fillable = array('code', 'name', 'price', 'note','unit','poradi');
	protected $dates = ['deleted_at'];

	public function category()
	{
		return $this->belongsTo('Category');
	}
}