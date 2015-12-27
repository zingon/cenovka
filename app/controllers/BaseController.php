<?php

class BaseController extends Controller {
	protected $first_login;
	public function __construct()
    {
    	$obj = UserSetting::where("user_id","=",Auth::getUser()->id)->first();
    	$this->first_login = $obj?0:1;
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
