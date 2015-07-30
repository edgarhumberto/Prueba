<?php 
 
class UbicacionesController extends BaseController {
 
    public function jsonPaises(){
	    return Response::json(Pais::all());
    }
    
    
    
    
    public function jsonCiudades(){
    	
    	$ciudades = array();
    	if(Input::get('id_pais')){
	    	$ciudades = Pais::find(Input::get('id_pais'))->ciudades;
    	}
    	else{
	    	$ciudades = Ciudad::all();
    	}
	    return Response::json($ciudades);
	    
    }
    
    public function jsonUbicacion(){
		if(Input::get('lat') && Input::get('lon')){		
			$lat = Input::get('lat');
			$lon = Input::get('lon');
			
			$ciudad = Ciudad::with('pais')->orderBy(DB::raw("SQRT(POW(69.1 * (lat - $lat), 2) + POW(69.1 * ($lon - lon) * COS(lat / 57.3), 2))", 'ASC'))->take(1)->get();
			
			return Response::json($ciudad->toArray());
		}
    }
    
    
 
}
?>