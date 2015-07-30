<?php  
class CategoriasQponesController extends BaseController {
	
	public function index(){
	
    	$categories = CategoriasQpon::paginate(10);
    	
	    return View::make('categorias.qpones.list')->with('categories', $categories);
    }
	
	public function create(){
		return View::make('categorias.qpones.create');
	}

	public function show($id){
	
	    $categoria = CategoriasQpon::find($id);
	    
	    return View::make('categorias.qpones.show')->with('categoria', $categoria);
    }
    
    public function edit($id){
    	
    	$categoria = CategoriasQpon::find($id);
    	
    	return View::make('categorias.qpones.edit')->with('categoria', $categoria);
    }
    
    public function update($id){
    
	    $categoria = CategoriasQpon::find($id);
		
		$rules = array(
            "nombre" => "required",
            "descripcion"  => "required"
        );
        
        $validator = Validator::make(Input::all(), $rules);
        
        if($validator->fails()) {
        	return Redirect::to("categoriasQpones.edit")
                ->withErrors($validator)
                ->withInput(Input::except("banner"));
        }else{
	        $categoria->update(Input::all());
	        
	        if(Input::hasFile('icono')){
				$file = Input::file('icono');
			    $extension = $file->getClientOriginalExtension();
			    $name = $file->getClientOriginalName();
			    $name = basename($name, ".png");

			    $path = public_path().'/img/emblemas/categorias';
			    
			    $image = Image::make(Input::file('icono')->getRealPath());
			    $image->fit(96, 96); //3x
				$filename3x = $name.'@3x.'.$extension;
				$image->save($path.'/'.$filename3x);
				
				$categoria->icono_emblema = $filename3x;
			}
			$categoria->save();
        }
        return Redirect::route('categoriasQpones.show', $categoria->id);
    }

	public function store(){
		$rules = array(
            "nombre" => "required",
            "descripcion"  => "required"
        );
        
        $validator = Validator::make(Input::all(), $rules);
        
        if($validator->fails()) {
        	return Redirect::to("categoriasQpones")
                ->withErrors($validator)
                ->withInput(Input::except("banner"));
        }else{
	    	$categoria = CategoriasQpon::create(Input::all());
			if(Input::hasFile('icono')){
				$file = Input::file('icono');
			    $extension = $file->getClientOriginalExtension();
			    $name = $file->getClientOriginalName();
			    $path = public_path().'/img/emblemas/categorias';
			    
			    $image = Image::make(Input::file('icono')->getRealPath());
			    $image->fit(96, 96); //3x
				$filename3x = $name.'@3x.'.$extension;
				$image->save($path.'/'.$filename3x);
				
				$categoria->icono_emblema = $filename3x;
			}
			$categoria->save();
        }
        
        return Redirect::route('categoriasQpones.show', $categoria->id);
	}
	
	public function destroy($id)
    {
        // delete
        $categoria = CategoriasQpon::find($id);
        $categoria->delete();

        return Redirect::to('categoriasQpones');
    }	
}
?>