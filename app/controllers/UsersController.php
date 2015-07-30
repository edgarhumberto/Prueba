<?php 
 
class UsersController extends BaseController {
 
    
    public function createUserProfile(){
	    
	    $user = User::create(Input::all());
		
		if(Input::hasFile('image')){
        	$imageName = $user->id.'.'.(Input::file('image')->getClientOriginalExtension());
	        Input::file('image')->move(public_path().'/storage/profiles/', $imageName);
	        $user->image = $imageName;
	        $user->save();
        }
        if($user->ciudad){
        	$user->ciudad->pais;
        }
        //echo json_encode($response);
        
        $response = array(
        	"status" => "OK",
        	"messages" => array(
        		"id" => 1,
        		"message" => "User profile was successfully created..."
        	),
        	"profile" => $user->toArray()
        );
        
        return Response::json($response);

        
    }
    
    public function updateUserProfile(){
	    $user = User::with('ciudad')->find(Input::get('id'));
	    
	    if($user){
		    $user->update(Input::all());
	    }
	    
	    if(Input::hasFile('image')){
		    $imageName = $user->id.'.'.(Input::file('image')->getClientOriginalExtension());
	        Input::file('image')->move(public_path().'/storage/profiles/', $imageName);
	        $user->image = $imageName;
			$user->save();
	    }
	    
	    $user = User::with('ciudad')->find(Input::get('id'));
	    $user->ciudad->pais;
	    
	    $response = array(
        	"status" => "OK",
        	"messages" => array(
        		"id" => 1,
        		"message" => "User profile was successfully updated..."
        	),
        	"profile" => $user->toArray()
        );
        
        return Response::json($response);
    }

}
?>