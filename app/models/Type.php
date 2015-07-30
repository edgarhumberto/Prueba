<?php
class Type extends Eloquent{
	
    protected $table = 'tipos';
    protected $fillable = array('nombre', 'descripcion');
    
	public function qpons(){
		return $this->hasMany('Qpon', 'tipo_id');
	}
	
}