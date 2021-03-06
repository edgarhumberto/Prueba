<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	protected $fillable = array('name', 'email', 'password', 'city_id', 'allowsLocationUsage', 'allowsPushNotifications', 'didAcceptTermsAndConditions', 'facebookID', 'facebookImageURL');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
	
	
	public function ciudad(){
	    return $this->belongsTo('Ciudad', 'city_id');
    }
    
    public function favoritos(){
		return $this->belongsToMany('Qpon', 'favoritos', 'id_user', 'id_qpon');
	}
	
	public function following(){
		return $this->belongsToMany('Negocio', 'followers', 'id_user', 'id_negocio');
	}

}