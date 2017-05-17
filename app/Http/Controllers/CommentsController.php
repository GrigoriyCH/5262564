<?php

namespace Japblog\Http\Controllers;

use Illuminate\Http\Request;

use Japblog\Http\Requests;

use Japblog\Repositories\CommentsRepository;

class CommentsController extends SiteController
{
    public function __construct(CommentsRepository $c_rep){

		$this->c_rep = $c_rep;
		
		}
		public function index($id_post = FALSE, $idp = FALSE){
			
			$article_id = $id_post;
			$comments = $this->getComments($idp,config('settings.get_comments'),$id_post);//dd($comments);
			if($comments)
			return view(env('THEME').'.commentsAjax')->with(['comments'=>$comments,'article_id'=>$article_id,'idp'=>$idp]);
			
		}
		public function getComments($idp,$take,$id_post)
    {
    	
		$comments = $this->c_rep->get2('*',$idp,$take,FALSE,['posts_id',$id_post],FALSE);
		
		if($comments){
			$comments->load('user');
		}
		
		return $comments;
	}
}
