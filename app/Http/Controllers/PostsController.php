<?php

namespace Japblog\Http\Controllers;

use Illuminate\Http\Request;

use Japblog\Http\Requests;

use Japblog\Http\Requests\SearchRequest;

use Japblog\Repositories\PostsRepository;
use Japblog\Repositories\CommentsRepository;
use Japblog\Category;
use Japblog\Repositories\CategoryRepository;

use Event;
use Japblog\Events\PostHasViewed;

use Auth;

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
	
	public function author($aut_alias = FALSE)
    {
        $articles = $this->getArticlesAut($aut_alias);
        return $this->AutPosts($articles);
    }
    
    public function allnews(){
		$news = 1;
    	$froms = $this->cat_rep->get('id',FALSE,FALSE,['parent_id',$news],FALSE);
    	
    	if($froms){
    	$catArray = array();
    	foreach($froms as $from)
    	{
			array_push($catArray,$from->id);
		} 	
		$articles = $this->getAllFrom($catArray, $news);
		}
		else{
		$articles = [FALSE,TRUE];	
		}
		
        return $this->mainSelect($articles);
	}
	public function allreview(){
		$review = 2;
    	$froms = $this->cat_rep->get('id',FALSE,FALSE,['parent_id',$review],FALSE);
    	
    	if($froms){
    	$catArray = array();
    	foreach($froms as $from)
    	{
			array_push($catArray,$from->id);
		} 	
		$articles = $this->getAllFrom($catArray, $review);
		}
		else{
		$articles = [FALSE,TRUE];	
		}
		
        return $this->mainSelect($articles);
	}
	public function alldifferent(){
		$different = 3;
    	$froms = $this->cat_rep->get('id',FALSE,FALSE,['parent_id',$different],FALSE);
    	
    	if($froms){
    	$catArray = array();
    	foreach($froms as $from)
    	{
			array_push($catArray,$from->id);
		} 	
		$articles = $this->getAllFrom($catArray, $different);
		}
		else{
		$articles = [FALSE,TRUE];	
		}
		
        return $this->mainSelect($articles);
	}
    public function getAllFrom($In = FALSE, $mainCategory){
    	$whereIn = FALSE;
    	$alias = TRUE;
		if(!empty($In)){
			$whereIn = ['category_id',$In];
		}
        
		$articles = $this->p_rep->get3(['id','title','created_at','img','text','user_id','category_id','keywords','meta_desc'],FALSE,TRUE,$whereIn,FALSE);
		
		if($articles){
			$articles->load('user','category','comments');
		}
		
		return [$articles,$alias,$mainCategory];
	}
    public function mainSelect($articles){
		$this->title = 'Все посты';
		
		if(isset($articles[2])){
			if(is_string($articles[2])){
				$this->title = $articles[2];
			}
			else{
				switch($articles[2])
					{
						case 1:
							$this->title = 'Новости';
							break;
						case 2:
							$this->title = 'Обзоры';
							break;
						case 3:
							$this->title = 'Разное';
							break;
					}
				}	
		}
		
        $content = view(env('THEME').'.articles_content')->with(['articles' => $articles[0],'alias' => $articles[1]])->render();
        $this->vars = array_add($this->vars,'content',$content);
        /////////////////////////////
        $comments = $this->getComments(config('settings.recent_comments'));//dd($comments);
        $randomposts = $this->getRandomposts(config('settings.recent_randomposts'));//dd($randomposts);
        $this->contentRightBar = view(env('THEME').'.articlesBar')->with(['comments'=>$comments, 'randomposts'=>$randomposts]);
        /////////////////////////////
        return $this->renderOutput();
	}
	public function AutPosts($articles){
		$this->title = 'Все посты: '.$articles->first()->user->name;
        $content = view(env('THEME').'.articles_content_aut')->with(['articles' => $articles])->render();
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
		$randomposts = $this->p_rep->get(['title','text','id','category_id','user_id'],$take,FALSE,FALSE,TRUE);
			if($randomposts){$randomposts->load('user');}
		return $randomposts;
	}	
    public function getArticles($id = FALSE)
    {
    	$where = FALSE;
		$catTitle = FALSE;
        $alias = TRUE;
    	if($id)
    	{		
        $alias = $this->cat_rep->get(['id','title'],FALSE,FALSE,['alias',$id],FALSE);
		$catTitle = $alias->first()->title;
    	if($alias){
			$alias = $alias->first()->id;
			$where = ['category_id',$alias];
		}else return [FALSE,FALSE,$catTitle];
    	}
		$articles = $this->p_rep->get(['id','title','created_at','img','text','user_id','category_id','keywords','meta_desc'],FALSE,TRUE,$where,FALSE);
		
		if($articles){
			$articles->load('user','category','comments');
		}
		
		return [$articles,$alias,$catTitle];
	}
	
	public function getArticlesAut($id = FALSE)
    {
    	$where = FALSE;
    	if($id)
    	{		
			$where = ['user_id',$id];
		}else
		return FALSE;
    	
		$articles = $this->p_rep->get(['id','title','created_at','img','text','user_id','category_id','keywords','meta_desc'],FALSE,TRUE,$where,FALSE);
		
		if($articles){
			$articles->load('user','category','comments');
		}
		
		return $articles;
	}
	
	public function show($id = FALSE, $attr = array()){
		
		//$article = $this->p_rep->one($id, ['comments'=>TRUE]); //dd($article);
		$article = $this->p_rep->one($id); //dd($article);
		if($article){
			//$article->img = json_decode($article->img);
			$article->load('user','category');
			/*счетчик просмотров +1*/
			event(new PostHasViewed($article));
		}
		/////////////////////////////////////////////////
		if(isset($article->id))
		{
			$this->title = $article->title;
			$this->keywords = $article->keywords;
			$this->meta_desc = $article->meta_desc;
		}
		/////////////////////////////////////////////////
		if(Auth::check())
			{
				$avatar_send = Auth::user()->avatar;
			}
			else
			{
				$avatar_send = config('settings.default_avatar');
			}
		/**/
		$content = view(env('THEME').'.article_content2')->with(['article'=>$article,'avatar_send'=>$avatar_send])->render();
		$this->vars = array_add($this->vars,'content',$content);
		
		$comments = $this->getComments(config('settings.recent_comments'));//dd($comments);
        $randomposts = $this->getRandomposts(config('settings.recent_randomposts'));//dd($randomposts);
        $this->contentRightBar = view(env('THEME').'.articlesBar')->with(['comments'=>$comments, 'randomposts'=>$randomposts]);
		
		return $this->renderOutput();
	}
    public function search(Request $request){
		//dd($request->result);
		if($request->result){
			$articles = $this->getSearch($request->result);
			$this->title = 'Результат поиска: '.$request->result;
			$result = true;
		}
		else{
			$articles = false;
			$this->title = 'Поиск';
			$result = false;
		}
		//dd($articles);
		$comments = $this->getComments(config('settings.recent_comments'));//dd($comments);
		$randomposts = $this->getRandomposts(config('settings.recent_randomposts'));//dd($randomposts);
		$this->contentRightBar = view(env('THEME').'.articlesBar')->with(['comments'=>$comments, 'randomposts'=>$randomposts]);
		
		$content = view(env('THEME').'.search_content')->with(['articles' => $articles, 'result' => $result, 'keysearch' => $request->result])->render();
		$this->vars = array_add($this->vars,'content',$content);
		
		return $this->renderOutput();
	}
	public function getSearch($key){
		
		$articles = $this->p_rep->getFind(['id','title','created_at','img','text','user_id','category_id','keywords','meta_desc'],$key,FALSE);
		
		if($articles){
			$articles->load('user','category','comments');
		}
		
		return $articles;
	}
}
