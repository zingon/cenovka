<?php
class SettingController extends BaseController
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$values = Module::with(array(
			"settings.setting_values" => function ($query) {
				$query->where("user_id", "=", Auth::getUser()->id);
			}
		))->get();

		return Response::view("setting.index", array(
			"module" => $values
		));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$data = new Setting;
		$title = "Nové nastavení";
		$modules = Module::all();
		return Response::view("setting.new", array(
			'data' => $data,
			"route" => "module.store",
			"method" => "POST",
			"title" => $title,
			"modules" => $modules
		));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {

		//

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {

		//

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {

		//

	}
}
