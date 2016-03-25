<?php

class ImportDocumentController extends \BaseController {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return Response::view("offer.import",array("method"=>"POST","route"=>"import.store"));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if (Input::hasFile('json') && Input::file("json")->isValid()){
			$document = json_decode(File::get(Input::file("json")))->document;
			//dd($document);
			$new_document = false;
			// Načtení nebo vytvoření odběratele
			$odberatel = Auth::getUser()->contacts()
					->where("id","=",$document->odberatel->id)
					->where("updated_at","=",$document->odberatel->updated_at)
					->first();

			if(!$odberatel) {

				$odberatel_save = array();
				foreach (ContactController::saveValuesForAll() as $key) {
					$odberatel_save[$key] = $document->odberatel->$key;
				}
				$odberatel = new Contact($odberatel_save);
				$odberatel->user()->associate(Auth::getUser());
				$odberatel->save();
			}
			
			//Načtení nebo vytvoření dokumentu
			$document_model = Auth::getUser()->documents()
						->where("id","=",$document->odberatel->id)
						->where("updated_at","=",$document->odberatel->updated_at)
						->first();

			if(!$document_model) {
				$document_model = $this->createDocument($document,$odberatel);
				$new_document = true;
			}

			$not_same_con = false; 
			if(!$new_document){
				foreach ($document->items_conection as $item_con) {
					$item_con_model = $document_model->items_conection()
						->where("id","=",$item_con->id)
						->where("updated_at","=",$item_con->updated_at)
						->first();
					
					$count = $document_model->items_conection()->count();
					
					if(!$item_con_model || $count != sizeof($document->items_conection)) {
						$document_model = $this->createDocument($document,$odberatel);
						$new_document = true;
					}
				}
			}
			foreach ($document->items_conection as $item_con) {
				// Načtení kategorie definované n souboru nebo vytvoření speciální kategorie(pokud už není vytvořena) 
				$category = Auth::getUser()->categories()
						->where("id","=",$item_con->item->category->id)
						->where("updated_at","=",$item_con->item->category->updated_at)
						->first();

				if(!$category) {
					$category = Auth::getUser()->categories()
						->where("class","=","import")
						->first();
					if(!$category) {
						$category_save = array(); 

						$category_save["name"] = "Importované";
						$category_save["note"] = "Tyto položky byly improtovány ze souboru";
						$category_save["class"] = "import";
						$category_save = array_add($category_save, 'code', CategoryController::getCode());

						$category = new Category($category_save);
						$category->user()->associate(Auth::getUser());
						$category->save();	
					}
				}

				$item = Auth::getUser()->items()
						->where("id","=",$item_con->item->id)
						->where("updated_at","=",$item_con->item->updated_at)
						->first();
				if(!$item) {
						$item_save = array(); 

						foreach (ItemController::saveValuesForAll() as $key) {
							$item_save[$key] = $item_con->item->$key;
						}
						$item_save = array_add($item_save, 'code', ItemController::getCode($category->id));

						$item = new Item($item_save);
						$item->user()->associate(Auth::getUser());
						$item->category()->associate($category);
						$item->save();		
				}

				if($new_document) {
					$item_con_new = $this->addItemToDocument($item_con,$item,$document_model);
				} 

			}
			
		}
	}

	private function createDocument($document,$odberatel) {
		$document_save = array();

		foreach (OfferController::saveValuesForAll() as $key) {
			$document_save[$key] = $document->$key;
		}
		$document_save = array_add($document_save,'code',OfferController::getCode());
		$document_model = new Document($document_save);
		$document_model->odberatel()->associate($odberatel);
		$document_model->user()->associate(Auth::getUser());
		$document_model->save();
		return $document_model;
	}

	private function addItemToDocument($item_con,$item,$document) {
		$con_save = array();
		$con_save["count"] = $item_con->count;
		$con_save["discount"] = $item_con->discount;

		$item_con_new = new DocumentItem($con_save);
		$item_con_new->document()->associate($document);
		$item_con_new->item()->associate($item);
		$item_con_new->save();
	}
}
