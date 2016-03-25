<?php
class ItemController extends BaseController
{

	/**
	 * Change position of ordered items
	 */
	/*public function changePosition() {
		$category_id = Input::get('category');
		$items_raw = Auth::getUser()->items()->where('category_id', "=", $category_id);

		$items_count = $items_raw->count();

		$item = Auth::getUser()->items()->find(Input::get("id"));

		$start_pos = $item->poradi;
		$end_pos = Input::get("to")+1;

		if($start_pos > $end_pos) {
			$items_to_change = Auth::getUser()->items()->where('category_id', "=", $category_id)->where("poradi",">=",$end_pos)->where("poradi","<",$start_pos)->get();
			foreach ($items_to_change as $item_to_change) {
				$item_to_change->increment('poradi')->save();
			}
		} else if($end_pos> $start_pos) {
			$items_to_change = Auth::getUser()->items()->where('category_id', "=", $category_id)->where("poradi","<=",$end_pos)->where("poradi",">",$start_pos)->get();
			foreach ($items_to_change as $item_to_change) {
				$item_to_change->decrement('poradi')->save();
			}
		}
		$item->poradi = $end_pos;

		$item->save();

	}*/

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		return Response::view('items.index');
	}
	
	public function getItems() {
		$items = Auth::user()->items()->with("category")->orderBy('code', 'desc')->get();
		return Response::json($items);
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$categories_native = Auth::getUser()->categories;
		$categories = array();

		foreach ($categories_native as $key => $value) {
			$categories[$value->id] = $value->name;
		}
		$data = new Item;
		$title = "Nová položka";
		return Response::view('items.new', array(
			'data' => $data,
			'categories' => $categories,
			"route" => "item.store",
			"method" => "POST",
			"title" => $title
		));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$validator = Validator::make(Input::all() , $this->saveValues());
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator);
		}
		else {
			$save = array();
			foreach ($this->saveValues() as $key => $value) {
				$save[$key] = Input::get($key);
			}

			$save['code'] = self::getCode(Input::get('category'));

			$last = $category->items()->orderBy('poradi', 'desc')->first();
			$save['poradi'] = empty($last->poradi) ? 1 : $last->poradi + 1;

			$category = Auth::getUser()->categories()->find(Input::get('category'));
			$item = new Item($save);
			$item->category()->associate($category);

			if (Auth::getUser()->items()->save($item)) {
				return Redirect::route('item.index', ['#' . $item->category->id])->with('global', 'Položka byla úspěšně přidána.');
			}
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$categories_native = Auth::getUser()->categories;
		$categories = array();

		foreach ($categories_native as $key => $value) {
			$categories[$value->id] = $value->name;
		}
		$categories = array_add($categories, null, 'Bez kategorie');
		$data = Auth::getUser()->items()->find($id);
		$title = "Editovat položku";
		return Response::view('items.new', array(
			'data' => $data,
			'categories' => $categories,
			"route" => array("item.update",$id),
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
	public function update($id) {
		$validator = Validator::make(Input::all() , $this->saveValues());
		if ($validator->fails()) {
			return Redirect::route('item.edit', $id)->withErrors($validator);
		}
		else {
			$item_category_id = isset($item->category->id) ? $item->category->id : 0;
			foreach ($this->saveValues() as $key => $value) {
				$$key = Input::get($key);
			}

			$item = Item::find($id);
			foreach ($this->saveValues() as $key => $value) {
				$item->$key = $$key;
			}

			if ($item_category_id != Input::get('category')) {
				$category = Auth::getUser()->categories()->find(Input::get('category'));
				$item->category()->associate($category);
			}

			if ($item->save()) {
				return Redirect::route('item.index')->with('global', 'Položka byla úspěšně upravena');
			}
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		Auth::getUser()->items()->where("id", "=", $id)->delete();
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

	private function saveValues() {
		return array(
			'name' => 'required|max:255',
			"price" => 'required|numeric',
			"buy_price" => 'numeric',
			'note' => 'max:65535',
			'unit' => 'required',
		);
	}
	public static function saveValuesForAll() {
		return array('name',"price","buy_price",'note','unit');
	}

	public static function getCode($category_id) {
		$category = Auth::getUser()->categories()->find($category_id);

		$last = $category->items()->orderBy('created_at', 'desc')->first();
		 // největší identifikační číslo

		if (empty($last->code)) {
			$code = sprintf("%04s", "1");
		}
		else {
			$code = sprintf("%04s", ($last->code + 1));
		}
		$category = Auth::getUser()->categories()->find($category_id);
		
		return $code . "/" . $category->code;
	}
}
