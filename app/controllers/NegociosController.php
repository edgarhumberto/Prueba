<?php 
 
class NegociosController extends BaseController {
 
    public function index(){
    	$negocios = Negocio::all();
    	
	    return View::make('negocios.index')->with('negocios', $negocios);
    }
    
    public function create(){
    
    	$paises		= Pais::all();
    	
    	$estados	= Region::all();
    	
    	$categorias = CategoriasNegocio::lists('nombre', 'id');
    	
	    return View::make('negocios.create')->with('paises', $paises)->with('estados', $estados)->with('categorias', $categorias);
    }
    
    public function store(){

    	$rules = array(
            "nombre" => "required",
            "radio"	 => "required",
            "categoria" => "required",
            "calle" => "required",
            "numeroExterior" => "required",
            "colonia" => "required",
            "cp" => "required",
            "ciudad" => "required",
            "estado" => "required",
            "pais" => "required",
            "latitud" => "required",
            "longitud" => "required"
        );
        
        $validator = Validator::make(Input::all(), $rules);
        
        if($validator->fails()) {
        	return Redirect::to("negocios")
                ->withErrors($validator)
                ->withInput(Input::except("banner"));
        }else{
	    	$negocio = Negocio::create(Input::all());
		
			$anioMes = date('Ym');
			
			if(Input::hasFile('icono_default')){
			    $file = Input::file('icono_default');
			    $extension = $file->getClientOriginalExtension();
			    $name = $file->getClientOriginalName();
			    $filename = md5(date("Ymdhis"));
			   
			    if($extension == 'jpg' || $extension == 'png' || $extension == 'jpeg'){
			    	
			    	$path = checkPath($anioMes, $negocio->id, 1);// 1 = icono
			    	$imagePath = url().'/'.$path;
			    	$path = public_path().'/'.$path;
			    	
				    $image = Image::make(Input::file('icono_default')->getRealPath());
				    $image->fit(198, 222); //3x
				    $filename3x = $filename.'@3x.'.$extension;
					$image->save($path.'/'.$filename3x);
					$image->fit(132, 148); //2x
					$filename2x = $filename.'@2x.'.$extension;
					$image->save($path.'/'.$filename2x);
				    $image->fit(66, 74); //1x
				    $filename1x = $filename.'.'.$extension;
				    $image->save($path.'/'.$filename1x);	    
				    
				    $negocio->icono_default = $anioMes.'/'.$negocio->id.'/icon/'.$filename1x;
			    }
			}
			if(Input::hasFile('portada')){
			    $file 			= Input::file('portada');
			    $extension 		= $file->getClientOriginalExtension();
			    $name 			= $file->getClientOriginalName();
			    $filename 		= md5(date("Ymdhis"));
			    
			    if($extension == 'jpg' || $extension == 'png' || $extension == 'jpeg'){
			    
			    	$path = checkPath($anioMes, $negocio->id, 2);// 2 = portada
			    	$imagePath = url().'/'.$path;
			    	$path = public_path().'/'.$path;
			    	
				    $image = Image::make(Input::file('portada')->getRealPath());
				    $image->fit(1280, 480); //3x
				    $filename3x = $filename.'@3x.'.$extension;
					$image->save($path.'/'.$filename3x);
					$image->fit(640, 240); //2x
					$filename2x = $filename.'@2x.'.$extension;
					$image->save($path.'/'.$filename2x);
				    $image->fit(320, 120); //1x
				    $filename1x = $filename.'.'.$extension;
				    $image->save($path.'/'.$filename1x);
				 	
				 	$negocio->portada = $anioMes.'/'.$negocio->id.'/portada/'.$filename1x; 
			    }
			}
			$negocio->save();   
        }
		return Redirect::route('negocios.show', $negocio->id);
    }
    
    public function show($id){
	    $negocio = Negocio::find($id);
	    //$anioMes = strftime("%Y%m",strtotime($negocio->created_at));
	    //echo $anioMes;
	    //echo " ".$negocio->id;
	    $imagenes = $negocio->imagenes;
	    
	    $qpones = $negocio->qpones;
	    
	    return View::make('negocios.show')->with('negocio', $negocio)->with('imagenes', $imagenes)->with('qpones', $qpones);
    }
    
  	public function jsonNegocio(){
	  	$id_negocio = Input::get('venue_id');
		$id_user = Input::get('id_usuario');
		$negocio = Negocio::with('qpones.category','qpones.negocio');
		$neg = Negocio::find($id_negocio);
		$imagenes = $neg->imagenes;
	  	
	  	//
	  	$negocio = $negocio->leftJoin('followers', function($join) use ($id_user)
        {
            $join->on('followers.id_negocio', '=', 'negocios.id')
                 ->where('followers.id_user', '=', $id_user);
        });
	  	$negocio = $negocio->selectRaw('*, CASE WHEN followers.id_user IS NULL THEN 0 ELSE 1 END AS following');
	  	//
	  	
	  	$negocio = $negocio->find($id_negocio);
	  	
		$user = User::find($id_user);	  	
	  	
	  	foreach($negocio->qpones as $qpon):
	  		$qpon->favorito = 0;
	  		if($user->favoritos->contains($qpon->id)){
		  		$qpon->favorito = 1;
	  		}
	  	endforeach;
	  	
	  	$negocio["header"] = array(
			"imagenes"	=> $imagenes
			);
			
	  	return Response::json($negocio);
  	}
  	
  	public function find(){
  	
  		if(Input::has('nombre')){
			$nombre = Input::get('nombre');
		}else{
			$nombre = false;
		}
		
		if(Input::has('ubicacion')){
			$ubicacion = Input::get('ubicacion');
		}else{
			$ubicacion = false;
		}
		
		$busqueda = Negocio::findPlace($nombre, $ubicacion);
		$negocios = Negocio::all();
		
		return View::make('negocios.index')->with('busqueda', $busqueda)->with('nombre', $nombre)->with('ubicacion', $ubicacion)->with('negocios', $negocios);
  	}
  	
  	public function followNegocio(){
	  	$id_usuario 		= Input::get('id_usuario');
		$id_negocio			= Input::get('venue_id');
		$follow				= Input::get('follow');
		$negocio			= Negocio::find($id_negocio);
		$user				= User::find($id_usuario);
		
		
		if(!empty($follow)){
			if(!$user->following->contains($id_negocio)){
				$user->following()->attach($id_negocio);	
			}
		}
		else{
			$user->following()->detach($id_negocio);
		}
  	}
  	
  	public function jsonSearch(){
		
		$user_id			= Input::get('user_id');
		$categorias 		= Input::get('categorias');
		$keywords			= Input::get('keywords');
		$tipo				= Input::get('tipo');
		$distancia			= Input::get('distancia');
		$lat				= Input::get('lat');
		$lon				= Input::get('lon');
		
		
		$negocios = new Negocio;
		$negocios = $negocios->with('category','followers');
		
			
		if(!empty($keywords)){
			$negocios = $negocios->where(function($query) use ($keywords){
				$query->where('nombre', 'like', "%$keywords%");
			});
		}
		
		if(!empty($distancia) && !empty($lat) && !empty($lon)){
			
			$negocios = $negocios->whereRaw("(SQRT(POW(69.1 * (latitud - $lat), 2) + POW(69.1 * ($lon - longitud) * COS(latitud / 57.3), 2)))*1000 <= $distancia");
			
		}
		
		$negocios = $negocios->leftJoin('followers', function($join) use ($user_id)
        {
            $join->on('followers.id_negocio', '=', 'negocios.id')
                 ->where('followers.id_user', '=', $user_id);
        });
               

		$negocios = $negocios->selectRaw('negocios.*, CASE WHEN followers.id_user IS NULL THEN 0 ELSE 1 END AS following');
		$negocios = $negocios->get();
		foreach($negocios as $negocio):
			$negocio->countFollowers = $negocio->followers->count();
		endforeach;
		
		$response = $negocios;
	
		
		
		return Response::json($response);
    }
    
    public function edit($id){
    	
    	$negocio = Negocio::find($id);
    	
    	$categorias = CategoriasNegocio::lists('nombre', 'id');
    	
    	return View::make('negocios.editar')->with('negocio', $negocio)->with('categorias', $categorias);
    }
    
    public function update($id){
		
		$rules = array(
            "nombre" => "required",
            "radio"	 => "required",
            "categoria" => "required",
            "calle" => "required",
            "numeroExterior" => "required",
            "colonia" => "required",
            "cp" => "required",
            "ciudad" => "required",
            "estado" => "required",
            "pais" => "required",
            "latitud" => "required",
            "longitud" => "required"
        );
        
        $validator = Validator::make(Input::all(), $rules);
        
        if($validator->fails()) {
        	return Redirect::to("negocios")
                ->withErrors($validator)
                ->withInput(Input::except("banner"));
        }else{
        
        	$negocio = Negocio::find($id);
        	
        	$icono = $negocio->icono_default;
        	$portada = $negocio->portada;

			$anioMes = strftime("%Y%m",strtotime($negocio->created_at));
			
			$negocio->update(Input::all());
			
			if(Input::hasFile('icono_default')){
			    $file = Input::file('icono_default');
			    $extension = $file->getClientOriginalExtension();
			    $name = $file->getClientOriginalName();
			    $filename = md5(date("Ymdhis"));
			   
			    if($extension == 'jpg' || $extension == 'png' || $extension == 'jpeg'){
			    	
			    	$path = checkPath($anioMes, $negocio->id, 1);// 1 = icono
			    	$imagePath = url().'/'.$path;
			    	$path = public_path().'/'.$path;
			    	
				    $image = Image::make(Input::file('icono_default')->getRealPath());
				    $image->fit(198, 222); //3x
				    $filename3x = $filename.'@3x.'.$extension;
					$image->save($path.'/'.$filename3x);
					$image->fit(132, 148); //2x
					$filename2x = $filename.'@2x.'.$extension;
					$image->save($path.'/'.$filename2x);
				    $image->fit(66, 74); //1x
				    $filename1x = $filename.'.'.$extension;
				    $image->save($path.'/'.$filename1x);	    
				    
				    $negocio->icono_default = $anioMes.'/'.$negocio->id.'/icon/'.$filename1x;
			    }
			}else{
				$negocio->icono_default = $icono;
			}
			if(Input::hasFile('portada')){
			    $file 			= Input::file('portada');
			    $extension 		= $file->getClientOriginalExtension();
			    $name 			= $file->getClientOriginalName();
			    $filename 		= md5(date("Ymdhis"));
			    
			    if($extension == 'jpg' || $extension == 'png' || $extension == 'jpeg'){
			    
			    	$path = checkPath($anioMes, $negocio->id, 2);// 2 = portada
			    	$imagePath = url().'/'.$path;
			    	$path = public_path().'/'.$path;
			    	
				    $image = Image::make(Input::file('portada')->getRealPath());
				    $image->fit(1280, 480); //3x
				    $filename3x = $filename.'@3x.'.$extension;
					$image->save($path.'/'.$filename3x);
					$image->fit(640, 240); //2x
					$filename2x = $filename.'@2x.'.$extension;
					$image->save($path.'/'.$filename2x);
				    $image->fit(320, 120); //1x
				    $filename1x = $filename.'.'.$extension;
				    $image->save($path.'/'.$filename1x);
				 	
				 	$negocio->portada = $anioMes.'/'.$negocio->id.'/portada/'.$filename1x; 
			    }
			}else{
				$negocio->portada = $portada;
			}
			$negocio->save();   
        }
		return Redirect::route('negocios.show', $negocio->id);
    }
    
    public function uploadFile(){
    
	    $negocio = Negocio::find(Input::get('negocio_id'));
	    
	    $anioMes = strftime("%Y%m",strtotime($negocio->created_at));
	    
		if(Input::hasFile('file')){
			$file = Input::file('file');
			$extension = $file->getClientOriginalExtension();
			$name = $file->getClientOriginalName();
			$filename = md5(date("Ymdhis"));
			
			if($extension == 'jpg' || $extension == 'png' || $extension == 'jpeg'){
				$SimplePath = checkPath($anioMes, $negocio->id, 3);// 3 = imagenes
				$path = public_path().'/'.$SimplePath;
				
				$image = Image::make(Input::file('file')->getRealPath());
				$image->fit(1280, 480); //3x
				$filename3x = $filename.'@3x.'.$extension;
				$image->save($path.'/'.$filename3x);
				$image->fit(640, 240); //2x
				$filename2x = $filename.'@2x.'.$extension;
				$image->save($path.'/'.$filename2x);
				$image->fit(320, 120); //1x
				$filename1x = $filename.'.'.$extension;
				$image->save($path.'/'.$filename1x);
			    
				$imagenNegocio = new Imagen;
				$imagenNegocio->imagen = $anioMes.'/'.$negocio->id.'/imagenes/'.$filename1x;
				$imagenNegocio->save();
				
				if($negocio->imagenes()->save($imagenNegocio)){
				    return Response::json(["response" => "ok", "img" => $anioMes.'/'.$negocio->id.'/imagenes/'.$filename1x]);
				}else{
				    return Response::json(["response" => "error"]);
				}
			}
		}else{
			return Response::json(["response" => "error"]);
		}
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