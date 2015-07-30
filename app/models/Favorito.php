<?php 
class Favorito extends Eloquent { //Todos los modelos deben extender la clase Eloquent
	
	protected $table = 'favoritos';
	protected $fillable = array('id_user', 'id_qpon');
	
}
?>