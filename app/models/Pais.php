<?php 
class Pais extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'paises';
    
    public function ciudades(){
	    return $this->hasMany('Ciudad', 'id_pais')->orderBy('name');
    }
    
    public function regiones(){
	    return $this->hasMany('Region', 'id_pais');
    }
    
}
?>