<?php

/**
*
*/
class OwnCellValue extends Model {

	protected $fillable = array('value');

	public function cell()
	{
		$this->belongsTo('OwnCell');
	}

	public function document()
	{
		$this->belongsTo('Document');
	}
}