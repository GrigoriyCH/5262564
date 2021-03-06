<?php

namespace Japblog\Http\Controllers;

use Illuminate\Http\Request;

use Japblog\Http\Requests;

use Japblog\Repositories\SlidersRepository;

use Japblog\Repositories\NewsRepository;

use Japblog\Repositories\PostsRepository;

use Config;

use Auth;

class IndexController extends SiteController
{
	public function __construct(SlidersRepository $s_rep, NewsRepository $n_rep, PostsRepository $p_rep){
		
		parent::__construct(new \Japblog\Repositories\MenusRepository(new \Japblog\Menu));
		
		$this->s_rep = $s_rep;
		$this->n_rep = $n_rep;
		$this->p_rep = $p_rep;
		
		$this->bar='right';
		$this->template = config('settings.theme').'.index';
		}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $news = $this->getNews();
		/*$iskl = '<a><p><br><strong><i>';*/
        
        //dd($news);
        /////////////////////////////
        $this->keywords = Config::get('about_site.keywords');
        $this->meta_desc = Config::get('about_site.meta_desc');
		
		if(Auth::check()){
			$this->title = "Мой Журнал: Добро пожаловать, " . Auth::user()->name;
		}else{
			$this->title = 'Мой Журнал';
		}
        /////////////////////////////
        $sliderItems = $this->getSliders();
        $sliders = view(config('settings.theme').'.slider')->with('sliders',$sliderItems)->render();
        $this->vars = array_add($this->vars,'sliders',$sliders);
        /////////////////////////////
        $posts = $this->getPosts(); //dd($posts);
        $this->contentRightBar = view(config('settings.theme').'.indexBar')->with('news',$news)->render();
		$content = view(config('settings.theme').'.content')->with(['posts'=>$posts])->render();
		$this->vars = array_add($this->vars,'content',$content);
        /////////////////////////////
        return $this->renderOutput();
    }
    
    protected function getNews(){
		
		$news = $this->n_rep->get(['id','title','img_mini'],Config::get('settings.home_port_count'),FALSE,FALSE,FALSE);
		return $news;
	}
	
	protected function getPosts(){
		
		$posts = $this->p_rep->get(['title','created_at','img','id','user_id','meta_desc'],Config::get('settings.home_posts_count'),FALSE,FALSE,FALSE);
			if($posts){$posts->load('user');}
		return $posts;
	}
    
    public function getSliders()
    {	
		$sliders = $this->s_rep->get();
		
		if($sliders->isEmpty()){
			return FALSE;		
		}
		
		$sliders->transform(function($item,$key){
			$item->img = Config::get('settings.slider_path').'/'.$item->img;
			return $item;
		});
		
		//dd($sliders);
		
		return $sliders;
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
