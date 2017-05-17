<?php

namespace Japblog\Http\Controllers;

use Illuminate\Http\Request;

use Japblog\Http\Requests;

use Japblog\Repositories\PostsRepository;
use Japblog\Repositories\CommentsRepository;
use Japblog\Category;
use Japblog\Repositories\CategoryRepository;

class PostsController extends SiteController
{
    //
    public function __construct(PostsRepository $p_rep, CommentsRepository $c_rep, CategoryRepository $cat_rep){
		
		parent::__construct(new \Japblog\Repositories\MenusRepository(new \Japblog\Menu));
		
		$this->p_rep = $p_rep;
		$this->c_rep = $c_rep;
		$this->cat_rep = $cat_rep;
		
		$this->bar='right';
		$this->template = env('THEME').'.articles';
		
		}
		
		public function index($cat_alias = FALSE)
    {
        $articles = $this->getArticles($cat_alias);
        return $this->mainSelect($articles);
    }
    
    public function allnews(){
    	$froms = $this->cat_rep->get('id',FALSE,FALSE,['parent_id','1'],FALSE);
    	
    	if($froms){
    	$catArray = array();
    	foreach($froms as $from)
    	{
			array_push($catArray,$from->id);
		} 	
		$articles = $this->getAllFrom($catArray);
		}
		else{
		$articles = [FALSE,TRUE];	
		}
		
        return $this->mainSelect($articles);
	}
	public function allreview(){
    	$froms = $this->cat_rep->get('id',FALSE,FALSE,['parent_id','2'],FALSE);
    	
    	if($froms){
    	$catArray = array();
    	foreach($froms as $from)
    	{
			array_push($catArray,$from->id);
		} 	
		$articles = $this->getAllFrom($catArray);
		}
		else{
		$articles = [FALSE,TRUE];	
		}
		
        return $this->mainSelect($articles);
	}
	public function allopinion(){
    	$froms = $this->cat_rep->get('id',FALSE,FALSE,['parent_id','3'],FALSE);
    	
    	if($froms){
    	$catArray = array();
    	foreach($froms as $from)
    	{
			array_push($catArray,$from->id);
		} 	
		$articles = $this->getAllFrom($catArray);
		}
		else{
		$articles = [FALSE,TRUE];	
		}
		
        return $this->mainSelect($articles);
	}
	
    public function getAllFrom($In = FALSE){
    	$whereIn = FALSE;
    	$alias = TRUE;
		if(!empty($In)){
			$whereIn = ['category_id',$In];
		}
        
		$articles = $this->p_rep->get3(['id','title','created_at','img','img_mini','text','user_id','category_id','keywords','meta_desc'],FALSE,TRUE,$whereIn,FALSE);
		
		if($articles){
			$articles->load('user','category','comments');
		}
		
		return [$articles,$alias];
	}
    
    public function mainSelect($articles){
		
        $content = view(env('THEME').'.articles_content')->with(['articles' => $articles[0],'alias' => $articles[1]])->render();
        $this->vars = array_add($this->vars,'content',$content);
        /////////////////////////////
        $comments = $this->getComments(config('settings.recent_comments'));//dd($comments);
        $randomposts = $this->getRandomposts(config('settings.recent_randomposts'));//dd($randomposts);
        $this->contentRightBar = view(env('THEME').'.articlesBar')->with(['comments'=>$comments, 'randomposts'=>$randomposts]);
        /////////////////////////////
        return $this->renderOutput();
	}
    
    public function getComments($take)
    {
		$comments = $this->c_rep->get(['text','name','email','site','posts_id','user_id'],$take,FALSE,FALSE,FALSE);
		
		if($comments){
			$comments->load('posts','user');
		}
		
		return $comments;
	}
    
     public function getRandomposts($take)
    {
		$randomposts = $this->p_rep->get(['title','text','id','img_mini','category_id'],$take,FALSE,FALSE,TRUE);
		return $randomposts;
	}
	
    public function getArticles($id = FALSE)
    {
    	$where = FALSE;
        $alias = TRUE;
    	if($id)
    	{		
        $alias = $this->cat_rep->get('id',FALSE,FALSE,['alias',$id],FALSE);
    	if($alias){
			$alias = $alias->first()->id;
			$where = ['category_id',$alias];
		}else return [FALSE,FALSE];
    	}
		$articles = $this->p_rep->get(['id','title','created_at','img','text','user_id','category_id','keywords','meta_desc'],FALSE,TRUE,$where,FALSE);
		
		if($articles){
			$articles->load('user','category','comments');
		}
		
		return [$articles,$alias];
	}
	
	public function show($id = FALSE, $attr = array()){
		
		//$article = $this->p_rep->one($id, ['comments'=>TRUE]); //dd($article);
		$article = $this->p_rep->one($id); //dd($article);
		if($article){
			//$article->img = json_decode($article->img);
			$article->load('user');
		
		/////////////////////////////////////////////////
		$this->title = $article->title;
		$this->keywords = $article->keywords;
		$this->meta_desc = $article->meta_desc;}
		/////////////////////////////////////////////////
		$content = view(env('THEME').'.article_content2')->with('article',$article)->render();
		$this->vars = array_add($this->vars,'content',$content);
		
		$comments = $this->getComments(config('settings.recent_comments'));//dd($comments);
        $randomposts = $this->getRandomposts(config('settings.recent_randomposts'));//dd($randomposts);
        $this->contentRightBar = view(env('THEME').'.articlesBar')->with(['comments'=>$comments, 'randomposts'=>$randomposts]);
		
		return $this->renderOutput();
	}
    
}
