<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Document extends Eloquent {

	use SoftDeletingTrait;

	protected $fillable = array('code', 'name', 'vystaven', 'expire','note','odberatel_id','dodavatel_id', 'dph','exported_document','last_update');
	protected $dates = ['deleted_at'];


    public function odberatel() {
    	return $this->belongsTo('Contact','odberatel_id','id')->withTrashed();
    }
    public function user() {
        return $this->belongsTo("User",'user_id');
    }

    public function items() {
    	return $this->belongsToMany('Item', 'document_items','document_id','item_id');
    }

    public function items_conection() {
    	return $this->hasMany('DocumentItem', 'document_id');
    }

    public function exported() {
        return $this->hasMany('ExportedDocument');
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