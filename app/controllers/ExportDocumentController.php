<?php

class ExportDocumentController extends \BaseController {


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$document_id = Input::get("document_id");
		$exported = Auth::getUser()->documents()->find($document_id)->exported()->orderBy("created_at","DESC")->get();
		return Response::json($exported);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$document_id = ExportedDocument::find($id)->actual->id;
		$exported =  Auth::getUser()->documents()->find($document_id)->exported()->find($id);

		return Response::make($exported->document);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*public function destroy($id)
	{
		//
	}*/




	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function export($document_id,$pdf = 0)
	{
		$version = Input::get("version",0);
		if(!$version) {
			$document = Auth::getUser()->documents()->with("odberatel","items_conection","items_conection.item","user.user_setting","user")->find($document_id);
			$document->total_price = 0;
				$dph_kons = $document->dph/100;
				foreach ($document->items_conection as $key => $item) {
					$price_discount = (($item->item->price/100)*(100-$item->discount));
					$price_tax = $price_discount+$price_discount*$dph_kons;
					$document->items_conection[$key]->with_tax_one = number_format($price_tax,2,","," ");
					$document->items_conection[$key]->with_tax_all = number_format($price_tax*$item->count,2,","," ");
					$document->items_conection[$key]->without_tax_one = number_format($price_discount,2,","," ");
					$document->items_conection[$key]->without_tax_all = number_format($price_discount*$item->count,2,","," ");
					$document->total_price += $price_tax*$item->count;
				}
				$document->total_price =number_format($document->total_price,2,","," ");
			$template = View::make('offer.document', array("document"=>$document));
		} else {
			$export = Auth::getUser()->documents()->find($document_id)->exported()->find($version);
			$template = $export->document;
		}
		if(!$pdf) {
			$document = Document::find($document->id);
			$export = new ExportedDocument();
			$export->document = $template;

			$export->actual()->associate($document);
			if($export->save()) {
				if(Request::ajax()) {

				} else {
					return Redirect::route("document.show",$document->id);
				}
			}
		} else {
			$view = mb_convert_encoding($template, 'HTML-ENTITIES', 'UTF-8');
			$pdf = App::make('dompdf');
			$pdf->loadHTML($view);
			return $pdf->download('temp.pdf');
		}
	}


}
