<?php
class CategoriasQpon extends Eloquent{
	
	use SoftDeletingTrait;
	protected $table = 'categoriasQpones';
    protected $fillable = array('nombre', 'descripcion', 'icono');
    
    public function negocio(){
		return $this->hasMany('Qpon', 'categoria_id');
	}
}
?>