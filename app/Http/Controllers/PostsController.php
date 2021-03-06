<?php

namespace Japblog\Http\Controllers;

use Illuminate\Http\Request;

use Japblog\Http\Requests;

use Japblog\Http\Requests\SearchRequest;

use Japblog\Repositories\PostsRepository;
use Japblog\Repositories\CommentsRepository;
use Japblog\Category;
use Japblog\Keywords;
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
		$this->template = config('settings.theme').'.articles';
		
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
		$this->title = "Мой Журнал: Все посты";
		
		if($articles[0]!=false){
			$array_art = array();
			
			$count_art = 0;
			
			foreach ($articles[0] as $article) {
				$count_art ++ ;
				array_push($array_art, $article->title);
			}
			
			$description = "На этой странице: ";
			
			for ($i=0; $i < $count_art; $i++)
			{
				$description = $description . $array_art[$i] . '; ';	
			}
			
			$this->meta_desc = $description;
			/*start gen keywords*/
			$genKeys = new Keywords();
			$keywords = $genKeys->seokeywords($description,5,7);
			/*end gen keywords*/
			$this->keywords = $keywords;
			
		}
		else{
			$description = "На этой странице пока что нет материала.";
			$this->meta_desc = $description;
			/*start gen keywords*/
			$genKeys = new Keywords();
			$keywords = $genKeys->seokeywords($description,5,7);
			/*end gen keywords*/
			$this->keywords = $keywords;
		}
		
		if(isset($articles[2])){
			if(is_string($articles[2])){
				$this->title = "Мой Журнал: " . $articles[2];
			}
			else{
				switch($articles[2])
					{
						case 1:
							$this->title = "Мой Журнал: Новости";
							break;
						case 2:
							$this->title = "Мой Журнал: Обзоры";
							break;
						case 3:
							$this->title = "Мой Журнал: Разное";
							break;
					}
				}	
		}
		//dd($articles);
        $content = view(config('settings.theme').'.articles_content')->with(['articles' => $articles[0],'alias' => $articles[1]])->render();
        $this->vars = array_add($this->vars,'content',$content);
        /////////////////////////////
        $comments = $this->getComments(config('settings.recent_comments'));//dd($comments);
        $randomposts = $this->getRandomposts(config('settings.recent_randomposts'));//dd($randomposts);
		
		$subscribe = false;
		$arrayAn = ['Новости аниме','Обзор аниме','Новости мультиков','Обзор мультиков'];
		$arrayTv = ['Новости телесериалов','Новости кино','Обзор кино','Обзор телесериалов'];
		foreach ($arrayAn as $a){
				if($a==$articles[2])
				{
					$subscribe = 'animation';
				}
			}
		foreach ($arrayTv as $a){
				if($a==$articles[2])
				{
					$subscribe = 'movies';
				}
			}	
		
        $this->contentRightBar = view(config('settings.theme').'.articlesBar')->with(['comments'=>$comments, 'randomposts'=>$randomposts, 'subscribe' => $subscribe]);
        /////////////////////////////
        return $this->renderOutput();
	}
	public function AutPosts($articles){
		$this->title = 'Мой Журнал - Все посты: '.$articles->first()->user->name;
        $content = view(config('settings.theme').'.articles_content_aut')->with(['articles' => $articles])->render();
        $this->vars = array_add($this->vars,'content',$content);
        /////////////////////////////
        $comments = $this->getComments(config('settings.recent_comments'));//dd($comments);
        $randomposts = $this->getRandomposts(config('settings.recent_randomposts'));//dd($randomposts);
        $this->contentRightBar = view(config('settings.theme').'.articlesBar')->with(['comments'=>$comments, 'randomposts'=>$randomposts]);
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
		$randomposts = $this->p_rep->get(['title','text','id','category_id','user_id','meta_desc'],$take,FALSE,FALSE,TRUE);
			if($randomposts){$randomposts->load('user');}
		return $randomposts;
	}	
    public function getArticles($id)
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
				}else{
					return [FALSE,FALSE,$catTitle];
				}
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
		}
		/////////////////////////////////////////////////
		if(isset($article->id))
		{
			$this->title = $article->title . " - Мой Журнал: " . $article->category->title;
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
		$subscribe = false;
		$arrayAn = ['Новости аниме','Обзор аниме','Новости мультиков','Обзор мультиков'];
		$arrayTv = ['Новости телесериалов','Новости кино','Обзор кино','Обзор телесериалов'];
		foreach ($arrayAn as $a){
				if($a==$article->category->title)
				{
					$subscribe = 'animation';
				}
			}
		foreach ($arrayTv as $a){
				if($a==$article->category->title)
				{
					$subscribe = 'movies';
				}
			}
			
		$content = view(config('settings.theme').'.article_content2')->with(['article'=>$article,'avatar_send'=>$avatar_send, 'subscribe'=>$subscribe])->render();
		$this->vars = array_add($this->vars,'content',$content);
		
		$comments = $this->getComments(config('settings.recent_comments'));//dd($comments);
        $randomposts = $this->getRandomposts(config('settings.recent_randomposts'));//dd($randomposts);
		
        $this->contentRightBar = view(config('settings.theme').'.articlesBar')->with(['comments'=>$comments, 'randomposts'=>$randomposts, 'subscribe' => $subscribe]);
		
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
			$this->title = "Мой Журнал: Поиск";
			$result = false;
		}
		//dd($articles);
		$this->meta_desc = "Страница поиска материала по сайту";
		$this->keywords = "поиск";
		
		$comments = $this->getComments(config('settings.recent_comments'));//dd($comments);
		$randomposts = $this->getRandomposts(config('settings.recent_randomposts'));//dd($randomposts);
		$this->contentRightBar = view(config('settings.theme').'.articlesBar')->with(['comments'=>$comments, 'randomposts'=>$randomposts]);
		
		$content = view(config('settings.theme').'.search_content')->with(['articles' => $articles, 'result' => $result, 'keysearch' => $request->result])->render();
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
