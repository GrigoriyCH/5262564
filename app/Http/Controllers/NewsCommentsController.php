<?php

namespace Japblog\Http\Controllers;

use Illuminate\Http\Request;

use Japblog\Http\Requests;

use Japblog\Repositories\NewsCommentsRepository;
use Japblog\Repositories\NewsRepository;

class NewsCommentsController extends SiteController
{
    public function __construct(NewsCommentsRepository $nc_rep, NewsRepository $n_rep){

		$this->nc_rep = $nc_rep;
		$this->n_rep = $n_rep;
		
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
    	
		$comments = $this->nc_rep->get2('*',$idp,$take,FALSE,['news_id',$id_post],FALSE);
		
		if($comments){
			$comments->load('user');
		}
		
		return $comments;
	}
		public function getPostUsedID($id_post)
		{
			$userid = $this->n_rep->oneUserID($id_post);
			return $userid;
		}
}
