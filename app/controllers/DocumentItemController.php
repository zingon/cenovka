<?php

class DocumentItemController extends BaseController {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data = new DocumentItem;
		$title = "Nová spojení";
		return Response::view('offer.connection.items_form', array(
			'data' => $data,
			"route" => "item.store",
			"method" => "POST",
			"title" => $title
		));
		// if(Session::get('document')=='new'){
		// 	$items = Auth::user()->items()->with('category')->get();
		// } else {
		// $document = Auth::user()->documents()->find(Session::get('document'));

		// if($document->items()->count()!=0&&Session::has('document')){

		// 	$keys = array();

		// 	foreach ($document->items as $value) {
		// 		$keys[] = $value->id;
		// 	}
		// 	$items = Auth::user()->items()->whereNotIn('id',$keys)->get();

		// } else {
		// 	$items = Auth::user()->items()->all();
		// }
		// }
		// return Response::view('offer.connection.new', array('items'=>$items));
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
			return Redirect::route('document.index')
                ->withErrors($validator);

		} else {

			foreach ($this->saveValues() as $key => $value) {
				$$key 	= json_decode(Input::get($key));
			}
			$document = Document::find(Session::get('document'));

			foreach ($data as $key => $item) {
				if(!empty($item->used) && $item->used) {
					$item_db = Item::find($item->id);
					$new = new DocumentItem(array(
					'count' 	=> $item->count,
			 		'discount' 	=> $item->discount
						));
					try {
						$new->item()->associate($item_db);
						$new->document()->associate($document);
						$new->save();
					} catch (Exception $e) {
						dd($e);
					}


				}
			}
			Session::forget('document');
			return Response::json(array("url"=>URL::route('document.show',$document->id)));
	 	}
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// $validator = Validator::make(Input::all(),$this->saveValues());

		// if($validator->fails()){
		// 	return Redirect::route('select.edit')
  //               ->withErrors($validator);

		// } else {

		// 	foreach ($this->saveValues() as $key => $value) {
		// 		$$key 	= Input::get($key);
		// 	}

		// 	foreach ($count as $key => $count) {
		// 		$documentItem = DocumentItem::right(array($key,$id))->first();
		// 		$documentItem->count	= $count;
		// 		$documentItem->discount	= $discount[$key];

		// 		$documentItem->save();
		// 	}
		// 	return Redirect::route('document.index');
	 // 	}
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//$id = Input::get('id');
	 	$item = DocumentItem::where('item_id','=',$id)->first();
	 	$item->delete();
	 	return Redirect::back()->with('warning','Položka byla úspěšně smazána !');
	}

	private function saveValues(){
		return array(
			'data' 		=> 'string',
			);
	}


}
