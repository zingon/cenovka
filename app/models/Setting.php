<?php

/**
* Volání jednotlivích modelů nastavení pomocí jednoho modelu
*/
class Setting
{

	function __construct($setting_name)
	{
		$setting_name = ucwords($setting_name)."Setting";
		if(class_exists($setting_name)) {
			$model = new $setting_name();
			$model->where("user_id","=",Auth::getUser()->id);
			if(!empty($model)) {
				return $model;
			} else {
				$new = new $setting_name();
				$new->user_id = Auth::getUser()->id;
				if($new->save()) {
					return $new;
				}
			}

		} else {

			Log::warning('Wrong setting model.');
			return false;
		}
	}
}

