<?php
class ItemController extends BaseController
{

	/**
	 * Change position of ordered items
	 */
	public function changePosition() {
		$category_id = Input::get('category');
		$items_raw = Auth::getUser()->items()->where('category_id', "=", $category_id);

		$items_count = $items_raw->count();
		$from = $items_count - Input::get('from');
		$to = $items_count - Input::get('to');

		$from_item = $items_raw->where('poradi', '=', $from)->first();
		$from_item_id = $from_item->id;
		$from = $from_item->poradi;

		$items_raw = Auth::getUser()->items()->where('category_id', "=", $category_id);
		if ($from < $to) {
			$items_betwen = $items_raw->where('poradi', '<=', $to)->where('poradi', '>', $from)->get();

			foreach ($items_betwen as $item) {
				$item->decrement('poradi');
			}
		}
		elseif ($from > $to) {
			$items_betwen = $items_raw->where('poradi', '>=', $to)->where('poradi', '<', $from)->get();
			foreach ($items_betwen as $item) {
				$item->increment('poradi');
			}
		}

		Auth::getUser()->items()->find($from_item_id)->update(array(
			'poradi' => $to
		));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		if (!Request::ajax()) {
			return Response::view('items.index');
		}
		else {
			$items = Auth::user()->items()->get();
			return Response::json($items);
		}
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

			$category = Auth::getUser()->categories()->find(Input::get('category'));

			$last = $category->items()->orderBy('created_at', 'desc')->first();
			 // největší identifikační číslo

			if (empty($last->code)) {
				$code = sprintf("%04s", "1");
			}
			else {
				$code = sprintf("%04s", ($last->code + 1));
			}

			$last = $category->items()->orderBy('poradi', 'desc')->first();
			 // nevíš postavení záznam na frontendu

			$save['code'] = $code . "/" . $category->code;
			$save['poradi'] = empty($last->poradi) ? 1 : $last->poradi + 1;

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
}
