<?php 
class Imagen extends Eloquent {

	protected $table = 'negocioImagenes';
	
	public function negocio()
    {
        return $this->belongsTo('Negocio', 'id', 'negocio_id');
    }
}
?>