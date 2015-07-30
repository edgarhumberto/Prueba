<?php  
class TypesController extends BaseController {
 
    public function json()
    {
        $types = Type::all();
        return Response::json($types);
    }
    
}