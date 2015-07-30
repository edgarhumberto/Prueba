<?php
class Category extends Eloquent{
	
    protected $table = 'categorias';
    protected $fillable = array('nombre', 'descripcion', 'icono');
    
	public function qpons(){
		return $this->hasMany('Qpon', 'categoria_id');
	}
	
}