<?php

namespace Japblog\Http\Controllers;

use Illuminate\Http\Request;

use Japblog\Http\Requests;

use Japblog\Repositories\CommentsRepository;
use Japblog\Repositories\PostsRepository;

class CommentsController extends SiteController
{
    public function __construct(CommentsRepository $c_rep, PostsRepository $p_rep){

		$this->c_rep = $c_rep;
		$this->p_rep = $p_rep;
		
		}
		public function index($id_post = FALSE, $idp = FALSE){
			
			$article_id = $this->getPostUsedID($id_post);
			//dd($article_id);
			$comments = $this->getComments($idp,config('settings.get_comments'),$id_post);//dd($comments);
			if($comments && $article_id)
			return view(config('settings.theme').'.commentsAjax')->with(['comments'=>$comments,'article_id'=>$article_id->user_id,'idp'=>$idp]);
			
		}
		public function getComments($idp,$take,$id_post)
    {
    	
		$comments = $this->c_rep->get2('*',$idp,$take,FALSE,['posts_id',$id_post],FALSE);
		
		if($comments){
			$comments->load('user');
		}
		
		return $comments;
	}
		public function getPostUsedID($id_post)
		{
			$userid = $this->p_rep->oneUserID($id_post);
			return $userid;
		}
}
