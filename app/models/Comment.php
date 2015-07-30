<?php 
class Comment extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'comments';
    protected $fillable = array('qpon_id', 'user_id', 'comment');
    
    public function qpon(){
	    return $this->belongsTo('Qpon', 'qpon_id');
    }
    
    public function user(){
	    return $this->belongsTo('User', 'user_id');
    }
    
}
?>