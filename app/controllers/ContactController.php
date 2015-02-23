<?php

class ContactController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		$contacts = Contact::orderBy('created_at','DESC')->paginate(10);
		return Response::view('contact.index', array('contacts' => $contacts));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return Response::view('contact.new');
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
			$save['me'] = (Input::get('me')!=null)?1:0;

			$contact = new Contact((array)$save);

			if($contact->save()){
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
		return Response::view('contact.edit',array('contact'=>Contact::find($id)));
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

			$contact = Contact::find($id);

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
		Contact::destroy($id);
		return Redirect::route('contact.index')
			->with('global','Položka byla úspěšně smazána.');
	}

	private function saveValues(){
		return array(
			'name' 			=> 'required|max:255|regex:/^[a-žA-Ž0-9\- ]+$/',
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
			'me'			=> '',
			);
	}
}
