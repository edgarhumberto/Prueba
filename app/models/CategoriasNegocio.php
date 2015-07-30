<?php
class CategoriasNegocio extends Eloquent{
	
	use SoftDeletingTrait;
	protected $table = 'categoriasNegocios';
    protected $fillable = array('nombre', 'descripcion', 'icono');
    
    public function negocios(){
		return $this->hasMany('Negocio', 'categoria');
	}
}
?>