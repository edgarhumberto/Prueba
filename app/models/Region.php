<?php 
class Region extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'regiones';
    
    public function pais(){
	    return $this->belongsTo('Pais', 'id_pais');
    }
    
    public function ciudades(){
	    return $this->hasMany('Ciudad', 'id_region');
    }
    
}
?>