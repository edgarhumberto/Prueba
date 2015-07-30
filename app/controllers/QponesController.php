<?php 
 
class QponesController extends BaseController {
 
    public function mostrarQpones()
    {
        $qpones = Qpon::all();
        return View::make('qpones.lista', array('qpones' => $qpones));
    }
 
    public function nuevoQpon()
    {
    	$categorias = CategoriasQpon::lists('nombre', 'id');
    	
    	$negocios = Negocio::lists('nombre', 'id');
    	
        return View::make('qpones.crear')->with('categorias', $categorias)->with('negocios', $negocios);
    }
 
    public function crearQpon()
    {
    	$rules = array(
            "nombre" => "required",
            "descripcion"  => "required",
            "latitud" => "required",
            "longitud" => "required",
            "banner" => "required|image|max:2048",
            "vigenciaHasta" => "required"
        );
		
        $messages = array(
            "required" => "Por favor ingresa un :attribute",
            "descripcion.required" => "Por favor ingresa una descripcion",
            "latitud.required" => "Por favor ingresa una latitud",
            "longitud.required" => "Por favor ingresa una longitud",
            "banner.required" => "Por favor ingresa una imagen",
            "banner.image" => "Por favor ingresa una imagen valida",
            "vigenciaHasta.required" => "Por favor ingresa una vigencia"
        );

        $validator = Validator::make(Input::all(), $rules, $messages);

        if($validator->fails()) {
            return Redirect::to("qpones/nuevo")
                ->withErrors($validator)
                ->withInput(Input::except("banner"));
        } else {

            $qpon = Qpon::create(Input::all());

            if(Input::hasFile("banner")){
            	$file = Input::file('banner');
			    $extension = $file->getClientOriginalExtension();
			    $name = $file->getClientOriginalName();
				$filename = $qpon->id;
				
            	$path = checkPathQpon($qpon->id);
            	$path = public_path().'/'.$path;
            	
            	$image = Image::make(Input::file('banner')->getRealPath());
			    $image->fit(198, 222); //3x
			    $filename3x = $filename.'@3x.'.$extension;
				$image->save($path.'/'.$filename3x);
				
				$image->fit(132, 148); //2x
				$filename2x = $filename.'@2x.'.$extension;
				$image->save($path.'/'.$filename2x);
				
			    $image->fit(66, 74); //1x
			    $filename1x = $filename.'.'.$extension;
			    $image->save($path.'/'.$filename1x);
        
                $qpon->banner = $filename3x;
            }
            
            $qpon->save();
            
    		return Redirect::to('qpones');
        }
    }
 
    public function verQpon($id)
    {
    	$qpon = Qpon::find($id);
        return View::make('qpones.ver', array('qpon' => $qpon));
    }
    
    public function editarQpon($id)
    {
        // $rules = array(
        //     "nombre" => "required",
        //     "descripcion" => "required",
        //     "latitud" => "required",
        //     "longitud" => "required",
        //     "vigenciaHasta" => "required"
        // );

        // $messages = array(
        //     "required" => "Por favor ingresa un :attribute",
        //     "descripcion.required" => "Por favor ingresa una descripcion",
        //     "latitud.required" => "Por favor ingresa una latitud",
        //     "longitud.required" => "Por favor ingresa una longitud",
        //     "vigenciaHasta.required" => "Por favor ingresa una vigencia"
        // );

        // $validator = Validator::make(Input::all(), $rules, $messages);

        // if($validator->fails()) {

        //     return Redirect::to("qpones/editar/" . $id)
        //         ->withErrors($validator);
        // }
        // else {

	       $qpon = Qpon::find($id);
	       
	       $categorias = CategoriasQpon::lists('nombre', 'id');
    	
		   $negocios = Negocio::lists('nombre', 'id');
		   
	       return View::make('qpones.editar', array('qpon' => $qpon, 'categorias' => $categorias, 'negocios' => $negocios));
        //}
    }
    
    public function actualizarQpon($id)
    {
    	
    	$qpon = Qpon::find($id);
    	
    	$rules = array(
            "nombre" => "required",
            "descripcion"  => "required",
            "latitud" => "required",
            "longitud" => "required",
            "vigenciaHasta" => "required"
        );
		
        $messages = array(
            "required" => "Por favor ingresa un :attribute",
            "descripcion.required" => "Por favor ingresa una descripcion",
            "latitud.required" => "Por favor ingresa una latitud",
            "longitud.required" => "Por favor ingresa una longitud",
            "banner.required" => "Por favor ingresa una imagen",
            "banner.image" => "Por favor ingresa una imagen valida",
            "vigenciaHasta.required" => "Por favor ingresa una vigencia"
        );

        $validator = Validator::make(Input::all(), $rules, $messages);

        if($validator->fails()){
            return Redirect::to("qpones/editar/".$qpon->id)
                ->withErrors($validator)
                ->withInput(Input::except("banner"));
        }else{
			$qpon->update(Input::all());

            if(Input::hasFile("banner")){
            	$file = Input::file('banner');
			    $extension = $file->getClientOriginalExtension();
			    $name = $file->getClientOriginalName();
				$filename = $qpon->id;
				
            	$path = checkPathQpon($qpon->id);
            	$path = public_path().'/'.$path;
            	
            	$image = Image::make(Input::file('banner')->getRealPath());
			    $image->fit(198, 222); //3x
			    $filename3x = $filename.'@3x.'.$extension;
				$image->save($path.'/'.$filename3x);
				
				$image->fit(132, 148); //2x
				$filename2x = $filename.'@2x.'.$extension;
				$image->save($path.'/'.$filename2x);
				
			    $image->fit(66, 74); //1x
			    $filename1x = $filename.'.'.$extension;
			    $image->save($path.'/'.$filename1x);
        
                $qpon->banner = $filename3x;
            }
            
            $qpon->save();
            
    		return Redirect::to('qpones');
        }
		
    }
    
    public function eliminarQpon($id){
    	$qpon = Qpon::find($id);
    	
    	$qpon->delete();
    	
	    return Redirect::to('qpones');
    }
    
    public function json(){
	    echo json_encode(Qpon::all());
    }
    
    public function jsonComments(){
    	$qpon = Qpon::find(Input::get('qpon_id'));
    	$comments = $qpon->comments;
    	foreach($comments as $comment):
    		$comment->user->ciudad->pais;
    	endforeach;
	    
	    $response = array(
	    	"status" 	=> "OK",
        	"messages" 	=> array(
        		"id" 		=> 1,
        		"message" 	=> "Comments were retrieved succesfully..."
        	),
        	"comments"	=> $comments
	    );
	    
	    return Response::json($response);
    }
    
    public function jsonSearch(){
		$user_id			= Input::get('user_id');
		$categorias 		= Input::get('categorias');
		$keywords			= Input::get('keywords');
		$tipo				= Input::get('tipo');
		$distancia			= Input::get('distancia');
		$lat				= Input::get('lat');
		$lon				= Input::get('lon');

		$qpon = new Qpon;
		$qpon = $qpon->with('category','negocio');
		if(!empty($keywords)){
			$qpon = $qpon->where(function($query) use ($keywords){
				$query->where('nombre', 'like', "%$keywords%")
					->orWhere('descripcion', 'like', "%$keywords%");
			});
		}
		$now = date("Y-m-d H:i:s");
		$qpon = $qpon->where('vigenciaHasta', '>' ,$now);
		if(!empty($distancia) && !empty($lat) && !empty($lon)){
			
			$qpon = $qpon->whereRaw("(SQRT(POW(69.1 * (latitud - $lat), 2) + POW(69.1 * ($lon - longitud) * COS(latitud / 57.3), 2)))*1000 <= $distancia");
			
		}
		
		$qpon = $qpon->leftJoin('favoritos', function($join) use ($user_id)
        {
            $join->on('favoritos.id_qpon', '=', 'qpones.id')
                 ->where('favoritos.id_user', '=', $user_id);
        });
        

		$qpon = $qpon->selectRaw('qpones.*, CASE WHEN favoritos.id_user IS NULL THEN 0 ELSE 1 END AS favorito');

		return Response::json($qpon->get());
    }
	
	public function likeQpon(){
		$id_usuario 		= Input::get('id_usuario');
		$id_qpon			= Input::get('id_qpon');
		$like				= Input::get('like');
		$qpon				= Qpon::find($id_qpon);
		$user				= User::find($id_usuario);
		
		if(!empty($like)){
			if(!$user->favoritos->contains($id_qpon)){
				$user->favoritos()->attach($id_qpon);	
			}
		}
		else{
			$user->favoritos()->detach($id_qpon);
		}
		
		$qpon->popularidad = $qpon->likes-count();
		$qpon->save();
	}
	
	public function favorites(){
		$id_usuario			= Input::get('user_id');
		$user				= User::find($id_usuario);
		
		return Response::json($user->favoritos);
	}
	
	public function consumir(){
		$qpon_id			= Input::get('qpon_id');
		$user_id			= Input::get('user_id');
		
		$qpon 				= Qpon::find($qpon_id);
		
		$response = array(
	    	"status" 	=> "ERROR",
        	"messages" 	=> array(
        		"id" 		=> 1,
        		"message" 	=> "An unknown error happened while processing your request..."
        	)
	    );
		
		if(strtotime($qpon->vigenciaHasta) < time()){
			
			$response["status"] = "OK";
			$response["messages"] = array(
				"id"		=> 1,
				"message"	=> "Request was processed successfully..."
			);
			$response["data"] = array(
				"exchangeCode"	=> md5(time()),
				"message" => "¡Gracias por usar este Qpon!"
			);
			return Response::json($response);
		}
	}
	
	public function jsonExplorar($page = 1){
		$user_id			= Input::get('user_id');
	
		$response = array(
	    	"status" 	=> "ERROR",
        	"messages" 	=> array(
        		"id" 		=> 1,
        		"message" 	=> "An unknown error happened while processing your request..."
        	)
	    );
	    
	    $qpones = Qpon::take(6)->with('category','negocio');
	    $qpones = $qpones->leftJoin('favoritos', function($join) use ($user_id)
        {
            $join->on('favoritos.id_qpon', '=', 'qpones.id')
                 ->where('favoritos.id_user', '=', $user_id);
        });
        $qpones = $qpones->selectRaw('qpones.*, CASE WHEN favoritos.id_user IS NULL THEN 0 ELSE 1 END AS favorito');
	    $qpones = $qpones->get();
		
		if($page > 4){
			$qpones = array();
		}
		
		$response["status"] = "OK";
		$response["messages"] = array(
			"id"		=> 1,
			"message"	=> "Request was processed successfully..."
		);
		$response["data"] = array(
			"qpons"				=> $qpones,
			"currentPage" 		=> $page,
			"nextPage"			=> $page > 3 ? null : $page+1
		);
		return Response::json($response);
	}
	
}
?>