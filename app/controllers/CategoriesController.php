<?php  
class CategoriesController extends BaseController {
 
    public function json()
    {
        $categories = Category::all();
        return Response::json($categories);
    }
    
    public function create(){
		return View::make('categorias.create');
	}
	
	public function show($id){
	    $categoria = Negocio::find($id);
	    //$anioMes = strftime("%Y%m",strtotime($negocio->created_at));
	    //echo $anioMes;
	    //echo " ".$negocio->id;
	    $imagenes = $negocio->imagenes;
	    
	    return View::make('negocios.show')->with('negocio', $negocio)->with('imagenes', $imagenes);
    }
	
	public function store(){
		$rules = array(
            "nombre" => "required",
            "descripcion"  => "required"
        );
        
        $validator = Validator::make(Input::all(), $rules, $messages);
        
        if($validator->fails()) {
        	return Redirect::to("categorias")
                ->withErrors($validator)
                ->withInput(Input::except("banner"));
        }else{
        	if(Input::get('tipo') != 0){
	        	$tipo = Input::get('tipo');
	        	if($tipo == 1){
		        	$categoria = CategoriasNegocio::create(Input::all());
	        	}else if($tipo == 2){
		        	$categoria = CategoriasQpon::create(Input::all());
	        	}
	        	if(Input::hasFile('icono')){
	        		$file = Input::file('icono');
				    $extension = $file->getClientOriginalExtension();
				    $name = $file->getClientOriginalName();
				    $path = public_path().'/img/emblemas/categorias';
				    
				    $image = Image::make(Input::file('icono')->getRealPath());
				    $image->fit(198, 222); //3x
					$filename3x = $name.'@3x.'.$extension;
					$image->save($path.'/'.$filename3x);
					
					$categoria->icono_emblema = $filename3x;
				}
				$categoria->save();
        	}
        }
        
        return View::make('categorias.show')->with('categoria', $categoria);
	}
    
}