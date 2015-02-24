<?php

class ItemController extends BaseController {

	public function changePosition($id,$action){
		$now = Item::find($id);
		$poradi = $now->poradi;

		if($action=="up"||$action=="down"){
			if($action=="up"){
				$poradi_next = $poradi-1;
			}
			else{
				$poradi_next = $poradi+1;
			}
			$next = Item::where('poradi','=',$poradi_next)->first();



			$now->poradi = $next->poradi;
			$next->poradi = $poradi;
			
			$next->save();
			$now->save();
		}
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		if(!Request::ajax()){
			$items = Item::orderBy('poradi','ASC')->get();
			return Response::view('items.index',array('items'=>$items));
		} else {
			return Response::json($items);
		}
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$categories_native = Category::all();
		$categories = array();

		foreach ($categories_native as $key => $value) {
			$categories[$value->id] = $value->name;
		}

		return Response::view('items.new',array('categories'=>$categories));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), $this->saveValues());
		if ($validator->fails()) {
			return Redirect::route('item.create')
                ->withErrors($validator);
		} else {

			$save = array();
			foreach($this->saveValues() as $key => $value) {
				$save[$key] = Input::get($key);
			}

			$category = Category::find(Input::get('category'));

			$last = $category->items()->orderBy('created_at','desc')->first();
			if(empty($last->code)){
				$code = sprintf("%04s","1");
			} else {
				$code = sprintf("%04s",($last->code+1));
			}

			
			

			$save['code'] = $code."/".$category->code; 
			$item = new Item($save);
			$item->category()->associate($category);

  			if($item->save()){
  				return Redirect::route('item.index')
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
		$categories_native = Category::all();
		$categories = array();

		foreach ($categories_native as $key => $value) {
			$categories[$value->id] = $value->name;
		}

		return Response::view('items.edit',array('item'=>Item::find($id), 'categories' => $categories));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validator = Validator::make(Input::all(), $this->saveValues());
		if ($validator->fails()) {
			return Redirect::route('item.edit',$id)
                ->withErrors($validator);
		} else {

			foreach ($this->saveValues() as $key => $value) {
				$$key = Input::get($key);
			}


			$item = Item::find($id);
			foreach ($this->saveValues() as $key => $value) {
				$item->$key 	= $$key;
			}

			if($item->category->id != Input::get('category')){
				$category = Category::find(Input::get('category'));
				$item->category()->associate($category);
			}	
			
			if($item->save()){
				return Redirect::route('item.index')
					->with('global','Položka byla úspěšně upravena');
			}
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Item::destroy($id);
		return Redirect::route('item.index')
			->with('global','Položka byla úspěšně smazána.');
	}

	private function saveValues()
	{
		return array(
			'name' 		=> 'required|max:255|regex:/^[a-žA-Ž0-9\-/\\.,()=*-+\"\' ]+$/',
            "price"   	=> 'required|alpha_dash',
            'note' 		=> 'max:65535',
            'unit'		=> 'required',
			);
	}


}
