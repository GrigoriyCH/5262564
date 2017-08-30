<?php

namespace Japblog\Http\Controllers;

use Illuminate\Http\Request;

use Japblog\Http\Requests;

use Japblog\Repositories\NewsRepository;
use Japblog\Repositories\NewsCommentsRepository;

use Auth;

class SitenewsController extends SiteController
{
    //
    public function __construct(NewsRepository $n_rep,NewsCommentsRepository $nc_rep){
		
		parent::__construct(new \Japblog\Repositories\MenusRepository(new \Japblog\Menu));
		
		$this->n_rep = $n_rep;
		$this->nc_rep = $nc_rep;
		
		$this->template = config('settings.theme').'.sitenews';
		
		}
		public function index()
    {
        //
        $this->title = 'Новости сайта';
        $this->keywords = 'Новости сайта';
        $this->meta_desc = 'Новости сайта';
		
        $sitenews = $this->getSiteNews();
        
        $content = view(config('settings.theme').'.sitenews_content')->with('sitenews',$sitenews)->render();
        $this->vars = array_add($this->vars,'content',$content);
        
        return $this->renderOutput();
    }
        public function getSiteNews(){
			$sitenews = $this->n_rep->get('*',FALSE,TRUE,FALSE,FALSE);
			//dd($sitenews);
			return $sitenews;
		}
		
	public function show($id = FALSE){
		$news = $this->n_rep->one($id); //dd($news);
		/*if($news){
			$news->img = json_decode($news->img);
		}*/
		/*  
		*/
		if($news)
		{$this->title = $news->title;}
		/*$this->keywords = $news->keywords;
		$this->meta_desc = $news->meta_desc;*/
		/*                                         */	
		if(Auth::check())
			{
				$avatar_send = Auth::user()->avatar;
			}
			else
			{
				$avatar_send = config('settings.default_avatar');
			}
			/**/
		$content = view(config('settings.theme').'.one_news_content')->with(['news'=>$news,'avatar_send'=>$avatar_send])->render();
		$this->vars = array_add($this->vars,'content',$content);
		
		return $this->renderOutput();
	}
	
	public function siterules(){
		$rules = config('rules');
		$this->title = 'Правила сайта';
		/*dd($rules);*/
		$content = view(config('settings.theme').'.siterules_content')->with('rules',$rules)->render();
        $this->vars = array_add($this->vars,'content',$content);
		
		return $this->renderOutput();
	}
	
}
