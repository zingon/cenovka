<?php

class UserController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::all();
		return Response::view('user.index',array('users'=>$users));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return Response::view('user.create');
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
			'password_again'=> 'same:password',
			));
		if($validator->fails()){
			return Redirect::back()
        		->withErrors($validator);
		}
		$email 		= Input::get('email');
		$password 	= Hash::make(Input::get('password'));

		$user = new User();

		$user->email = $email;
		$user->password = $password;

		if($user->save()) {
			Auth::login($user,false);
			return Redirect::to("/");

		}

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*public function edit($id)
	{
		//
	}*/


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*public function update($id)
	{
		//
	}*/


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(Auth::getUser()->admin){
			$user = User::find($id);
			$user->destroy($id);
			return Redirect::route('user.index')
				->with('global','Uživatel byl úspěšně smazán.');
		}
	}


}
