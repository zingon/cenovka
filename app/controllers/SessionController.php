<?php

class SessionController extends BaseController {


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return Response::view('session.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(),array(
			'email' 		=> 'email|required',
			'password' 		=> 'min:8|required',
			));
		if($validator->fails()){
			return Redirect::back()
        		->withErrors($validator);
		}
		$email = Input::get("email");
		$password = Input::get("password");
		$remember	= (Input::get('remember-me',false))?true:false;

			if(Auth::attempt(array('email' => $email, 'password' => $password),$remember)){
				if(Auth::getUser()->admin) {
					return Redirect::route('admin.user.index');
				} else {
					return Redirect::route('document.index');
				}
			} else {
				return Redirect::back()
					->with("wrong", "Zadaný email/heslo nebyl/o nalezen/o");
			}
		}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		Auth::logout();
		return Redirect::to("/");

	}


}
