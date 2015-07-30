<?php  
class CategoriasNegociosController extends BaseController {

	public function index(){
	
    	$categories = CategoriasNegocio::paginate(10);
    	
	    return View::make('categorias.negocios.list')->with('categories', $categories);
    }
	
	public function create(){
		return View::make('categorias.negocios.create');
	}
	
	public function show($id){
	
	    $categoria = CategoriasNegocio::find($id);
	    
	    return View::make('categorias.negocios.show')->with('categoria', $categoria);
    }
    
    public function edit($id){
    	
    	$categoria = CategoriasNegocio::find($id);
    	
    	return View::make('categorias.negocios.edit')->with('categoria', $categoria);
    }
    
    public function update($id){
    
	    $categoria = CategoriasNegocio::find($id);
		
		$rules = array(
            "nombre" => "required",
            "descripcion"  => "required"
        );
        
        $validator = Validator::make(Input::all(), $rules);
        
        if($validator->fails()) {
        	return Redirect::to("categoriasNegocios.edit")
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
        return Redirect::route('categoriasNegocios.show', $categoria->id);
    }

	public function store(){
		$rules = array(
            "nombre" => "required",
            "descripcion"  => "required"
        );
        
        $validator = Validator::make(Input::all(), $rules);
        
        if($validator->fails()) {
        	return Redirect::to("categoriasNegocios")
                ->withErrors($validator)
                ->withInput(Input::except("banner"));
        }else{
	    	$categoria = CategoriasNegocio::create(Input::all());
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
        
        return Redirect::route('categoriasNegocios.show', $categoria->id);
	}
	
	public function destroy($id)
    {
        // delete
        $categoria = CategoriasNegocio::find($id);
        $categoria->delete();

        return Redirect::to('categoriasNegocios');
    }
	
}
?>