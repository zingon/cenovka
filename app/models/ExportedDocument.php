<?php

class ExportedDocument extends Eloquent {

	protected $fillable = array();

	public function actual()
	{
		return $this->belongsTo('Document','document_id');
	}
}