<?php
class DocumentItem extends Eloquent {
	protected $fillable = array('count','discount');

	public function document()
	{
		return $this->belongsTo('Document','document_id');
	}

	public function item()
	{
		return $this->belongsTo('Item','item_id')->withTrashed();
	}

	public function scopeRight($query,$array=array())
    {
        return $query->where('item_id', '=', $array[0])->where('document_id', '=', $array[1]);
    }
}