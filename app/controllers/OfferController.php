<?php

class OfferController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

			return Response::view('offer.index');


	}
	public function getOffers() {
		$documents = Auth::getUser()->documents()->with("odberatel","user","user.user_setting","items_conection")->orderBy('created_at','DESC')->get();
		return Response::json($documents);
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

			return Response::json(array('type'=>'danger','messages'=>$validator->messages()));
		} else {

			$save = array();
			foreach ($this->saveValues() as $key => $value) {
				$save[$key] 	= Input::get($key);
			}
			$odberatel_id = Input::get('odberatel');

			$odberatel = Auth::getUser()->contacts()->find($odberatel_id);


			$last = Auth::getUser()->documents()->orderBy('created_at','desc')->first();

			$code = self::getCode();
			$expire = Input::get("expire");$vystaven = Input::get("expire");

			$expire = DateTime::createFromFormat('d.m.Y', $expire);
			$save["expire"] = $expire->format("Y-m-d");

			$vystaven = DateTime::createFromFormat('d.m.Y', $vystaven);
			$save["vystaven"] = $vystaven->format("Y-m-d");

			$save = array_add($save,'code',$code);

			$document = new Document($save);

			$document->odberatel()->associate($odberatel);
			$document->user()->associate(Auth::getUser());



			if($document->save());{

					Session::forget('document');
					Session::put('document',$document->id);
					return Response::json(array('type'=>'success','m'=>'Dokument byl úspěšně přidán.','document'=>$document->id));

			}
		}
	}

	// public function reload($id)
	// {
	// 	$document = Auth::getUser()->documents()->find($id);
	// 	$total_price=0;
	// 	$polozky = array();
	// 	$dph_kons = $document->dph/100;

	// 	foreach ($document->items()->withTrashed()->get() as $key => $item) {

	// 		$connection = DocumentItem::right(array($item->id,$document->id))->first();
	// 		$item_price = ($item->price * $connection->count) - (($item->price/100*$connection->discount)*$connection->count);
	// 		$total_price += round($item_price,2);


	// 		$polozky[$item->id] 				= $item;
	// 		$polozky[$item->id]->priceDiscount 	= $item_price;
	// 		$polozky[$item->id]->count 			= $connection->count;
	// 		$polozky[$item->id]->discount 		= $connection->discount;
	// 		$polozky[$item->id]->unit 			= explode('^',$item->unit);
	// 	}

	// 	$document->exported_document = View::make('offer.test',array(
	// 		'document' => $document,
	// 		'polozky' => $polozky,
	// 		'total_price' => $total_price,
	// 		'dph_kons'	=> $dph_kons,
	// 		));
	// 	$date = new DateTime();
	// 	$document->last_update = $date;
	// 	if($document->save()){
	// 		return Redirect::route('document.show',array($document->id));
	// 	}
	// }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

		if(Request::ajax()){

			$document = Auth::getUser()->documents()->with("odberatel","items_conection","items_conection.item","user.user_setting","user")->find($id);
			$document->total_price = 0;
			$document->total_price_without_tax = 0;
			$document->total_tax = 0;
			$dph_kons = $document->dph/100;
			foreach ($document->items_conection as $key => $item) {
				$price_discount = (($item->item->price/100)*(100-$item->discount));
				$price_tax = $price_discount+$price_discount*$dph_kons;
				$document->items_conection[$key]->with_tax_one = number_format($price_tax,2,","," ");
				$document->items_conection[$key]->with_tax_all = number_format($price_tax*$item->count,2,","," ");
				$document->items_conection[$key]->without_tax_one = number_format($price_discount,2,","," ");
				$document->items_conection[$key]->without_tax_all = number_format($price_discount*$item->count,2,","," ");
				$document->total_price += $price_tax*$item->count;
				$document->total_price_without_tax += $price_discount*$item->count;
				
			}
			$document->total_tax +=($document->total_price-$document->total_price_without_tax);
			$document->total_price =number_format($document->total_price,2,","," ");
			$document->total_price_without_tax = number_format($document->total_price_without_tax,2,","," ");
			$document->total_tax = number_format($document->total_tax,2,","," ");
			return Response::json($document);
		}else {
			return Response::view('offer.show',array("id"=>$id));
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
		$data = Auth::getUser()->documents()->find($id);
		$title = "Editace nabídky - " . $data->code;
		$edit = 1;

		$dodavatel = Auth::getUser()->user_setting()->first();
		$odberatele_full = Auth::getUser()->contacts()->get();
		$odberatele = array();
		foreach ($odberatele_full as $key => $value) {
			$odberatele[$value->id] = $value->name;
		}

		Session::forget('document');
		Session::put('document',$data->id);

		return Response::view('offer.new', array(
			"title"=>$title,
			"edit"=>$edit,
			"route" => array("document.update",$data->id),
			"method" => "PUT",
			"data" => $data,
			"dodavatel" => $dodavatel,
			"odberatele" => $odberatele
			));


		// foreach ($document->items()->withTrashed()->get() as $key => $item) {

		// 	$connection = DocumentItem::right(array($item->id,$document->id))->first();
		// 	$polozky[$item->id] = $item;
	 // 		$polozky[$item->id]->count = $connection->count;
	 // 		$polozky[$item->id]->discount = $connection->discount;
	 // 		$polozky[$item->id]->con_id = $connection->id;

		// }
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//dd(Input::all());
		$validator = Validator::make(Input::all(),$this->saveValues());

		if($validator->fails()){
			return Redirect::route('document.index')
				->withErrors($validator);

		} else {

			foreach ($this->saveValues() as $key => $value) {
				$$key 	= Input::get($key,'');
			}

			$document = Auth::getUser()->documents()->find($id);
			$expire = DateTime::createFromFormat('d.m.Y', $expire);
			$expire = $expire->format("Y-m-d");
			$vystaven = DateTime::createFromFormat('d.m.Y', $vystaven);
			$vystaven = $vystaven->format("Y-m-d");
			foreach ($this->saveValues() as $key => $value) {
				$document->$key = $$key;
			}

			if($document->save()){
				Session::forget('document');
				if(Request::ajax()) {
					return Response::json(array(
						"messages" => array(
							array(
								"type" => "success",
								"text" => "Položka byla úspěšně uložena."
							)
						)
					));
				} else {
					return Redirect::route('document.index');
				}
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

		//Session::forget('document');
		 Auth::getUser()->documents()->where("id", "=", $id)->delete();
		 if (Request::ajax()) {
			return Response::json(array(
				"messages" => array(
					array(
						"type" => "warning",
						"text" => "Položka byla úspěšně smazána."
					)
				)
			));
		}
		else {
			return Redirect::route('item.index')->with('global', 'Položka byla úspěšně smazána.');
		}

	}

	private function saveValues()
	{
		return array(
				'name' 		=> 'required|max:255',
				'vystaven' 	=> 'required|date_format:d.m.Y',
				'expire' 	=> 'required|date_format:d.m.Y',
				'note' 		=> 'max:65535',
				'dph' 		=> 'required|numeric|in:21,15,0',
			);
	}
	public static function saveValuesForAll()
	{
		return array('name','vystaven','expire','note','dph');
	}

	public static function getCode() {
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
			return $code;
	}

}
