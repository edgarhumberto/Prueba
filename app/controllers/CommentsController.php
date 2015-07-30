<?php 
 
class CommentsController extends BaseController {
 
    public function saveComment()
    {
		$comment = Comment::create(Input::all());
		$comment->user;
		$comment->qpon;		
		
		$response = array(
	    	"status" 	=> "OK",
        	"messages" 	=> array(
        		"id" 		=> 1,
        		"message" 	=> "Comment was saved succesfully..."
        	),
        	"comment"	=> $comment->toArray()
	    );
		
		return Response::json($response);
    }

}