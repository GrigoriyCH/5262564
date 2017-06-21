<?php

namespace Japblog\Http\Controllers;

use Illuminate\Http\Request;

use Japblog\Http\Requests;

use Japblog\Repositories\NewsRepository;
use Japblog\Repositories\NewsCommentsRepository;

class SitenewsController extends SiteController
{
    //
    public function __construct(NewsRepository $n_rep,NewsCommentsRepository $nc_rep){
		
		parent::__construct(new \Japblog\Repositories\MenusRepository(new \Japblog\Menu));
		
		$this->n_rep = $n_rep;
		$this->nc_rep = $nc_rep;
		
		$this->template = env('THEME').'.sitenews';
		
		}
		public function index()
    {
        //
        $this->title = 'Новости сайта';
        $this->keywords = 'Новости сайта';
        $this->meta_desc = 'Новости сайта';
		
        $sitenews = $this->getSiteNews();
        
        $content = view(env('THEME').'.sitenews_content')->with('sitenews',$sitenews)->render();
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
		$content = view(env('THEME').'.one_news_content')->with(['news'=>$news])->render();
		$this->vars = array_add($this->vars,'content',$content);
		
		return $this->renderOutput();
	}
	
}
