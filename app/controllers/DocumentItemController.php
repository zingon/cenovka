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
			return Redirect::route('select.create')
                ->withErrors($validator);

		} else {

			foreach ($this->saveValues() as $key => $value) {
				$$key 	= Input::get($key);
			}
			$document = Document::find(Session::get('document'));
			foreach ($selected as $key => $value) {
				$item = Item::find($key);
				$new = new DocumentItem(array(
					'count' 	=> $count[$item->id],
					'discount' 	=> $discount[$item->id],
					));
				$new->item()->associate($item);
				$new->document()->associate($document);
				$new->save();
			}

			if(empty($document->exported_document)){

			$total_price=0;
		 	$polozky = array();
		 	$dph_kons = $document->dph/100;

			foreach ($document->items()->withTrashed()->get() as $key => $item) {
				$connection = DocumentItem::right(array($item->id,$document->id))->first();
	 			$item_price = ($item->price * $connection->count) - (($item->price/100*$connection->discount)*$connection->count);
	 			$total_price += round($item_price,2);


		 		$polozky[$item->id] 				= $item;
		 		$polozky[$item->id]->priceDiscount 	= $item_price;
		 		$polozky[$item->id]->count 			= $connection->count;
		 		$polozky[$item->id]->discount 		= $connection->discount;
		 		$polozky[$item->id]->unit 			= explode('^',$item->unit);
			}
			$view = View::make('offer.export',array(
	 		'document' => $document,
	 		'polozky' => $polozky,
	 		'total_price' => $total_price,
	 		'dph_kons'	=> $dph_kons,
	 		));
			$date = new DateTime();
	 		$document->exported_document = $view;
	 		$document->last_update = $date->getTimestamp();
	 		if($document->save()){
	 			return Redirect::route('document.index',array(Session::get('document')));
	 		}
	 	} else {
	 		return Redirect::route('document.index',array(Session::get('document')));
		}
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
			return Redirect::route('select.edit')
                ->withErrors($validator);

		} else {

			foreach ($this->saveValues() as $key => $value) {
				$$key 	= Input::get($key);
			}

			foreach ($count as $key => $count) {
				$documentItem = DocumentItem::right(array($key,$id))->first();
				$documentItem->count	= $count;
				$documentItem->discount	= $discount[$key];

				$documentItem->save();
			}
			return Redirect::route('document.index');
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
	 	$item = DocumentItem::where('item_id','=',$id)->first();
	 	$item->delete();
	 	return Redirect::back()->with('warning','Položka byla úspěšně smazána !');
	}

	private function saveValues(){
		return array(
			'selected' 	=> 'array',
			'count' 	=> 'array',
			'discount' 	=> 'array'
			);
	}


}
