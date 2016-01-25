<?php

class OfferController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (!Request::ajax()) {
			return Response::view('offer.index');
		} else {
			$documents = Auth::getUser()->documents()->orderBy('created_at','DESC')->get();
			return Response::json($documents);
		}

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		/*$dodavatel = Auth::getUser()->contacts()->where('me','=',true)->first();
		$odberatele_native = Auth::getUser()->contacts()->where('me','!=',true)->get();
		$odberatele = array();
		Session::put('document',"new");*/

		$title = "Nová nabídka";
		$edit = 0;
		$data = new Document;
		$dodavatel = Auth::getUser()->user_setting()->first();
		$odberatele_full = Auth::getUser()->contacts()->get();
		$odberatele = array();
		foreach ($odberatele_full as $key => $value) {
			$odberatele[$value->id] = $value->name;
		}
		return Response::view('offer.new', array(
			"title"=>$title,
			"edit"=>$edit,
			"route" => "document.store",
			"method" => "POST",
			"data" => $data,
			"dodavatel" => $dodavatel,
			"odberatele" => $odberatele
			));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Redirect
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(),$this->saveValues());

		if($validator->fails()){

			return Response::json(array('type'=>'danger','m'=>$validator->messages()));
		} else {

			$save = array();
			foreach ($this->saveValues() as $key => $value) {
				$save[$key] 	= Input::get($key);
			}
			$save['odberatel'] = Input::get('odberatel');

			$odberatel = Auth::getUser()->contacts()->find($save['odberatel']);
			$dodavatel = Auth::getUser()->contacts()->where('me','=',true)->first();

			$last = Auth::getUser()->documents()->orderBy('created_at','desc')->first();

			if(empty($last->code)){
				$code = sprintf("%04s","1") ."/".date('Y',time());
			} else {
				$last_code = explode('/',$last->code);
				if($last_code[1]!=date('Y',time())){
					$code = sprintf("%04s","1") ."/".date('Y',time());
				} else {
					$code = sprintf("%04s",($last_code[0]+1)) ."/".date('Y',time());
				}
			}

			$save = array_add($save,'code',$code);

			$document = new Document($save);
			$document->odberatel()->associate($odberatel);
			$document->dodavatel()->associate($dodavatel);

			if(Auth::getUser()->documents()->save($document)){
				Session::forget('document');
				Session::put('document',$document->id);
				return Response::json(array('type'=>'success','m'=>'Dokument byl úspěšně přidán.','document'=>$document->id));
			}
		}
	}

	public function reload($id)
	{
		$document = Auth::getUser()->documents()->find($id);
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

	 	$document->exported_document = View::make('offer.test',array(
	 		'document' => $document,
	 		'polozky' => $polozky,
	 		'total_price' => $total_price,
	 		'dph_kons'	=> $dph_kons,
	 		));
	 	$date = new DateTime();
	 	$document->last_update = $date;
	 	if($document->save()){
	 		return Redirect::route('document.show',array($document->id));
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
	 	$document = Auth::getUser()->documents()->find($id);
	 	/*$total_price=0;
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
	 	}*/
	 	return Response::view('offer.show',array('document' => $document));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$document 	= Auth::getUser()->documents()->find($id);
		$polozky	= array();

		foreach ($document->items()->withTrashed()->get() as $key => $item) {

			$connection = DocumentItem::right(array($item->id,$document->id))->first();
			$polozky[$item->id] = $item;
	 		$polozky[$item->id]->count = $connection->count;
	 		$polozky[$item->id]->discount = $connection->discount;
	 		$polozky[$item->id]->con_id = $connection->id;

		}
		Session::forget('document');
		Session::put('document',$document->id);
		return Response::view('offer.edit', array(
			'document'		=>$document,
			'items'		=>$polozky
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
			return Redirect::route('document.index')
        		->withErrors($validator);

		} else {

			foreach ($this->saveValues() as $key => $value) {
				$$key 	= Input::get($key,'');
			}

			$document = Auth::getUser()->documents()->find($id);
			foreach ($this->saveValues() as $key => $value) {
				$document->$key = $$key;
			}

			if($document->save()){
				Session::forget('document');
				return Redirect::route('document.index');
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
		Session::forget('document');
		Auth::getUser()->documents()->destroy($id);
		return Redirect::back()
			->with('global','Položka byla úspěšně smazána.');

	}

	public function exportPdf($id)
	{
		$document = Auth::getUser()->documents()->find($id);
		$pdf = PDF::loadView('offer.pdf',array('document' => $document));
		return Response::view('offer.pdf');
	}

	private function saveValues()
	{
		return array(
				'name' 		=> 'required|max:255',
				'vystaven' 	=> 'required|date_format:Y-m-d',
				'expire' 	=> 'required|date_format:Y-m-d',
				'note' 		=> 'max:65535',
				'dph' 		=> 'required|numeric|in:21,15,0',
			);
	}

}
