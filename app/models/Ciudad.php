<?php 
class Ciudad extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'ciudades';
    
    public function pais(){
	    return $this->belongsTo('Pais', 'id_pais');
    }
    
    public function region(){
	    return $this->belongsTo('Region', 'id_region');
    }
    
    public function users(){
	    return $this->hasMany('User', 'city_id');
    }
    
    
}
?>