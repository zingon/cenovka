<?php

class DocumentItemController extends BaseController {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		return Response::view('offer.connection.items_form', array(

			"route" => "select.store",
			"method" => "POST",
			"edit" =>0
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
			return Redirect::route('document.index')
                ->withErrors($validator);

		} else {

			foreach ($this->saveValues() as $key => $value) {
				$$key 	= json_decode(Input::get($key));
			}
			$document_id = isset($document_id)?$document_id:Session::get('document');
			$document = Document::find($document_id);

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
			return Response::json(array(
						"messages" => array(
							array(
								"type" => "success",
								"text" => "Dokument byl úspěšně uložen."
							)
						)
					));
	 	}
	}
	/**
	 *	Post selected items by AJAX
	 *
	 * @param int $id Document id
	 * @return Response
	 *
	 */
	public function edit($id) {
		if(Input::get("edit",0)) {
			return Response::view('offer.connection.items_form', array(
				"edit" => 1,
				"route" => array("select.update",$id),
				"method" => "PUT",
			));
		} else {
			$document = Auth::getUser()->documents()->find($id);
			$items = $document->items_conection()->with("item")->get();
			return Response::json($items);
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
		 $validator = Validator::make(Input::all(),$this->saveValues());

		 if($validator->fails()){
		 	return Response::json(array('type'=>'danger','messages'=>$validator->messages()));

		 } else {

		 	foreach ($this->saveValues() as $key => $value) {
		 		$$key 	= json_decode(Input::get($key));
		 	}
		 	foreach ($data as $key => $item) {

		 		$documentItem = DocumentItem::find($item->id);
		 		if($id == $documentItem->document->id) {
		 			$documentItem->count	= $item->count;
					$documentItem->discount	= $item->discount;

					$documentItem->save();
		 		}

		 	}
		 	return Response::json(array(
						"messages" => array(
							array(
								"type" => "success",
								"text" => "Dokument byl úspěšně uložen."
							)
						)
					));
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
		//$id = Input::get('id');
	 	$item = DocumentItem::where('id','=',$id)->first();
	 	$item->delete();
	 	return Response::json(array(
						"messages" => array(
							array(
								"type" => "success",
								"text" => "Položka byla úspěšně smazána."
							)
						)
					));
	}

	private function saveValues(){
		return array(
			'data' 			=> 'string',
			'document_id'	=> 'integer',
			);
	}


}
