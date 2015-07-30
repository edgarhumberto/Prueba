<?php 
use Carbon\Carbon; 
class MobileController extends BaseController {
 
    
    public function login(){
	    
	    $response = array(
        	"status" => "ERROR",
        	"messages" => array(
        		"id" => 1,
        		"message" => "Incorrect user data..."
        	)
        );
	    
	    if(Input::has('facebookID')){
		    
			$facebookID = Input::get('facebookID');
			$user = User::with('ciudad')->where('facebookID', $facebookID)->take(1)->first();
			
	    }
	    else if(Input::has('email') && Input::has('password')){
		    $email 		= Input::get('email');
		    $password 	= Input::get('password');
		    
		    $user = User::with('ciudad')->where('email', $email)->where('password', $password)->take(1)->first();
		    
	    }
	    
	    if($user){
		    $user->ciudad->pais;
		    
			$response = array();
			
		    if($user){
	
		    	//Generar token
		    	$token = md5($user->id.$user->name.time());
		    	$session = new MobileSession;
		    	$session->user()->associate($user);
		    	$session->token = $token;
		    	$session->validFrom = Carbon::now();
		    	
		    	if(Config::get('qpon.MOBILE_SESSION_TIMEOUT')){
		    		$session->validTo = Carbon::now()->addMinutes(Config::get('qpon.MOBILE_SESSION_TIMEOUT'));
		    	}
		    	$session->save();
		    	
		    	$response = array(
			    	"status" 	=> "OK",
		        	"messages" 	=> array(
		        		"id" 		=> 1,
		        		"message" 	=> "User logged in succesfully..."
		        	),
		        	"profile"	=> $user->toArray(),
		        	"session" 	=> $session->toArray()
			    );
			    
		    }
		    else{
			    $response = array(
		        	"status" => "ERROR",
		        	"messages" => array(
		        		"id" => 1,
		        		"message" => "User does not exist or login data is incorrect..."
		        	)
		        );
		    }
	    }
	    
	    
	    return Response::json($response);
    }
    
    public function logout(){
	    $email 		= Input::get('email');
	    $token 		= Input::get('token');
	    $user 		= User::where('email', $email)->take(1)->first();
	    $sessions 	= MobileSession::where('user_id', $user->id)->where('token', $token)->get();
	    foreach($sesiones as $sesion):
	    
	    endforeach;
    }
 
}
?>