<?php
class CategoryController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $categories = Auth::getUser()->categories;
        if(Request::ajax()) {
            return Response::json($categories);
        } else {

            return Response::view('category.index', array('categories' => $categories));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $last = Auth::getUser()->categories()->orderBy('code','DESC')->first();
        $code = isset($last->code)?sprintf("%03s",$last->code+1):sprintf("%04s","1");
        return Response::view('category.new',array('code'=> $code));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $validator = Validator::make(Input::all(),$this->saveValues());

        if($validator->fails()){
            return Redirect::route('item.index')
                ->withErrors($validator);
        } else {
            $save = array();
            foreach ($this->saveValues() as $key => $value) {
                $save[$key] = Input::get($key);
            }
            $last = Auth::getUser()->categories()->orderBy('code','DESC')->first();

            $save['code']   = isset($last->code)?sprintf("%03s",$last->code+1):sprintf("%03s","1");
            $save['class']  = implode('-', explode(' ', Input::get('name')));

            $category = new Category($save);
            $category->user()->associate(Auth::getUser());
            if($category->save()){

                return Redirect::route('item.index')
                    ->with('global','Kategorie byla úspěšně přidána.');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        if($id == 0){
            $items = Auth::getUser()->items()->where('category_id',"=",0)->orderBy('poradi','DESC')->get();
        } else {
            $items = Auth::getUser()->items()->where('category_id','=',$id)->orderBy('poradi','desc')->get();
        }
        return Response::view("category.show",array("items"=>$items));
    }

    public function edit() {
        $category = Auth::getUser()->categories;
        return Response::view('category.edit',array('categories'=>$category));
    }

    public function update($id) {
        foreach (Input::get("categories") as $key => $value) {
            $validator = Validator::make($value,$this->saveValues());
            if($validator->fails()){
            return Redirect::route('item.index')
                ->withErrors($validator);
            } else {
                $category = Auth::getUser()->categories()->find($key);
                foreach ($this->saveValues() as $sKey => $save) {
                    $category->$sKey = $value[$sKey];
                }
                $category->save();
            }

        }
           return Redirect::route('item.index')
                    ->with('global','Kategorie byly úspěšně upraveny.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $category = Auth::getUser()->categories()->find($id);
        $undefined_category = Auth::getUser()->categories()->where("code",'=',"000")->first();
        if(!sizeof($undefined_category)) {
                $undefined_category = new Category(array("name"=>"Nedefinováná","code" => "000","class"=>"undefined"));
                $undefined_category =Auth::getUser()->categories()->save($undefined_category);
            }
        if($category->id != $undefined_category->id) {
            
            $items = Auth::getUser()->items()->withTrashed()->where('category_id','=',$id)->get();
            foreach ($items as $key => $item) {
                $item->category()->associate($undefined_category)->save();
            }
            $category->delete();
            if(Request::ajax()) {
          
                return Response::json(array("messages"=>array('type'=>'warning','text'=>'Položka byla úspěšně smazána!')));
            } else {
                return Redirect::back()->with('warning','Položka byla úspěšně smazána!');
            }
        } else {
            if(Request::json()) {
                return Response::json(array("messages"=>array('type'=>'warning','text'=>'Tato kategorie nemůže být smazána.')));
            } else {
                return Redirect::back()->with('global','Pokud jsou v této kategorii položky tak nemůže být smazána!');
            }

        }
    }

    private function saveValues() {
        return array(
            'name' => 'required|max:255',
            'note' => 'max:65535',
            );
    }
}
