<?php 
class Qpon extends Eloquent { //Todos los modelos deben extender la clase Eloquent

	use SoftDeletingTrait;
    protected $table = 'qpones';
    protected $fillable = array('nombre', 'descripcion', 'latitud', 'longitud', 'vigenciaHasta', 'id_negocio', 'categoria_id');
    
    public function negocio(){
		return $this->belongsTo('Negocio', 'id_negocio');
	}
	
	public function comments(){
		return $this->hasMany('Comment', 'qpon_id');
	}
	
	public function category(){
		return $this->belongsTo('CategoriasQpon', 'categoria_id');
	}
	
	public function likes(){
		return $this->hasMany('Favorito', 'id_qpon');
	}

}
?>