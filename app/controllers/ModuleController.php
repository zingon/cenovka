<?php
class ModuleController extends \BaseController
{

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$title = "Vytvořit nový modul";
		$data = new Module;
		return Response::view("module.new", array(
			'data' => $data,
			"route" => "module.store",
			"method" => "POST",
			"title" => $title
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

		$title = "Vytvořit nový modul";
		$data = Module::find($id);
		return Response::view("module.new", array(
			'data' => $data,
			"route" => "module.store",
			"method" => "POST",
			"title" => $title
		));


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

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {


	}
}
