<?php
class SettingController extends BaseController
{
	private $settings = array("user" => "Uživatelská nastavení");
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		return Response::view("setting.index",array("settings" => $this->settings));
	}


	public function getUserSetting($id=null) {

		$title = "Nastavení uživatele - Vaše fakturační údaje";
		if(!$id) {
			$data = UserSetting::findOrCreate(["user_id" => Auth::getUser()->id]);
		} else {
			$data = Auth::getUser()->user_setting()->find($id);
		}

		return Response::view('setting.user', array(
			'data' => $data,
			"route" => "post.setting.user",
			"method" => "POST",
			"title" => $title
		));

	}

	public function postUserSetting() {
		$validator = Validator::make(Input::all(),$this->saveValues("user"));
        if($validator->fails()){
        	return Redirect::back()
        		->withErrors($validator)
        		->withInput();
        } else {
        	$setting = UserSetting::findOrCreate(["user_id" => Auth::getUser()->id]);
        	foreach ($this->saveValues("user") as $key => $value) {
				$setting->$key = Input::get($key);
			}

			//$setting = new UserSetting((array)$save);
			$instance = Auth::getUser()->user_setting();
				if($instance->save($setting)){

					return Redirect::back()
						->with('global','Položka byla úspěšně přidána.');
				}
        	}
	}

	private function saveValues($type){
		$saveValues = array();
		switch ($type) {
			case 'user':
				$saveValues = array(
					'name' 			=> 'required|max:255',
					'firstname' 	=> 'max:80',
					'lastname' 		=> 'max:80',
					'phone'			=> 'max:80',
					'city' 			=> '',
					'zip_code'		=> 'max:6',
					'adress'		=> 'max:255',
					'ic'			=> '',
					'dic'			=> '',
					);
				break;

			default:
				# code...
				break;
		}
		return $saveValues;
	}
}
