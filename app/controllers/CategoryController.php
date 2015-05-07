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
        return Response::view('category.index', array('categories' => $categories));
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
            
            $category = Auth::getUser()->categories();

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
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $category = Auth::getUser()->categories()->find($id);
        $items = Auth::getUser()->categories()->where('category_id','=',$id)->update(array('category_id'=>0));
        $category->delete();
        return Redirect::back()->with('warning','Položka byla úspěšně smazána !');
    }

    private function saveValues() {
        return array(
            'name' => 'required|max:255',
            'note' => 'max:65535',
            );
    }
}
