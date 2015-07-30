<?php 
class Negocio extends Eloquent { //Todos los modelos deben extender la clase Eloquent

	use SoftDeletingTrait;
    protected $table = 'negocios';
    protected $fillable = array('nombre','radio','categoria','plaza','calle','numeroExterior','numeroInterior','colonia','cp','delegacion','ciudad','estado','pais','municipio','descripcion','icono_default','portada','latitud','longitud');
    
    public function qpones(){
	    return $this->hasMany('Qpon', 'id_negocio')->where('habilitado', 1)->orderBy('vigenciaHasta');
    }
    
    public function Ciudad(){
	    return $this->belongsTo('Ciudad', 'id_ciudad');
    }
    
    public function Estado(){
	    return $this->belongsTo('Region', 'id_region');
    }
    
    public function Pais(){
	    return $this->belongsTo('Pais', 'id_pais');
    }
    
    public static function findPlace($nombre = false, $ubicacion = false){
    	
    	$busqueda = Negocio::select('*');
    	
    	if($ubicacion){
	    	$busqueda->where(DB::raw('concat_ws(" ", calle, numeroExterior, numeroInterior,colonia, cp, delegacion, ciudad, municipio, estado, pais)'),'like', '%'.$ubicacion.'%');	
    	}
    	
    	if($nombre){
	    	$busqueda->where('nombre', 'like', $nombre);
    	}
                     
        return $busqueda->first();
    }
    
    public function imagenes()
    {
        return $this->hasMany('Imagen', 'negocio_id');
    }
    
    public function category(){
		return $this->belongsTo('CategoriasNegocio', 'categoria');
	}

	public function followers(){
		return $this->belongsToMany('User', 'followers', 'id_negocio', 'id_user');
	}

    
}
?>