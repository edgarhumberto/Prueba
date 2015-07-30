<?php 
class MobileSession extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'sessions';
    
    public function user(){
	    return $this->belongsTo('User', 'user_id');
    }
    
}
?>