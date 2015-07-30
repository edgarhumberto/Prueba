<?php  
class HistoryController extends BaseController {
 
    public function historyUser()
    {
        $user = User::find(Input::get('user_id'));


        $usuario["header"] = array(
			"favoritos"	=> $user->favoritos->count(),
            "following"	=> $user->following->count()
			);
        return Response::json($usuario);
    }
    
}