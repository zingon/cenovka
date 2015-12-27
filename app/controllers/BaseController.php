<?php

class BaseController extends Controller {
	protected $first_login = 0;
	public function __construct()
    {
    	if(!Auth::guest()){
    		$obj = UserSetting::where("user_id","=",Auth::getUser()->id)->first();
    		$this->first_login = $obj?0:1;
    	} else {
    		$this->first_login = null;
    	}
    		View::share('first_login', $this->first_login);


    }

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
