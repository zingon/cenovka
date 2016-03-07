<?php

class ContactController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Request::ajax()){
			$contacts = Auth::getUser()->contacts()->where("hidden","=",0)->get();
			return Response::json($contacts);
		} else {
			$contacts = Auth::getUser()->contacts()->where("hidden","=",0)->get();
			return Response::view('contact.index', array('contacts' => $contacts));
		}
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data = new Contact;
		$title = "Nový kontakt";
		return Response::view('contact.new',array(
			'data' => $data,
			"route" => "contact.store",
			"method" => "POST",
			"title" => $title
			));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(),$this->saveValues());
        if($validator->fails()){
        	return Redirect::route('contact.index')
        		->withErrors($validator)
        		->withInput();
        } else {

        	$save = array();
        	foreach ($this->saveValues() as $key => $value) {
				$save[$key] = Input::get($key);
			}

			$contact = new Contact((array)$save);
			$instance = Auth::getUser()->contacts();
				if($instance->save($contact)){

					return Redirect::route('contact.index')
						->with('global','Položka byla úspěšně přidána.');
				}
        	}

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = Auth::getUser()->contacts()->find($id);
		$title = "Editovat kontakt";
		return Response::view('contact.new', array(
			'data' => $data,
			"route" => array("contact.update",$id),
			"method" => "PUT",
			"title" => $title
		));

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validator = Validator::make(Input::all(),$this->saveValues());

        if($validator->fails()){

        	return Redirect::route('contact.edit')
        		->withErrors($validator);
        } else {

        	foreach ($this->saveValues() as $key => $value) {
				$$key = Input::get($key);
			}

			$contact = Auth::getUser()->contacts()->find($id);

			foreach ($this->saveValues() as $key => $value) {
				$contact->$key = $$key;
			}

			if($contact->save()){
				return Redirect::route('contact.index')
					->with('global','Položka byla úspěšně přidána.');
			}
        }
	}

	public function show($ic)
	{
		return Response::ajax(getContactsBy($ic));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Auth::getUser()->contacts()->where("id","=",$id)->delete();
		if (Request::ajax()) {
			return Response::json(array(
				"messages" => array(
					array(
						"type" => "warning",
						"text" => "Položka byla úspěšně smazána."
					)
				)
			));
		} else {
		return Redirect::route('contact.index')
			->with('global','Položka byla úspěšně smazána.');
		}
			
	}

	private function saveValues(){
		return array(
			'name' 			=> 'required|max:255',
			'firstname' 	=> 'max:80',
			'lastname' 		=> 'max:80',
			'email'			=> 'max:255|email',
			'phone'			=> 'max:80',
			'city' 			=> '',
			'zip_code'		=> 'max:6',
			'adress'		=> 'max:255',
			'ic'			=> '',
			'dic'			=> '',
			'note'			=> 'max:65535',
			'hidden'			=> '',
			);
	}
}
