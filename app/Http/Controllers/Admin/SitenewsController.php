<?php

namespace Japblog\Http\Controllers\Admin;

use Illuminate\Http\Request;

//use Japblog\Http\Requests;
use Japblog\Http\Requests\SitenewsRequest;

use Japblog\Http\Controllers\Controller;

use Japblog\Repositories\NewsRepository;

use Gate;
use Japblog\News;

class SitenewsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function __construct(NewsRepository $n_rep){
		
		parent::__construct();
		
		if(Gate::denies('VIEW_ADMIN_SITENEWS')){
			abort(403);
		}
		
		$this->n_rep = $n_rep;
		
		$this->template = env('THEME').'.admin.sitenews';
	}
	
    public function index()
    {
        //
		$this->title = 'Менеджер Новостей сайта';
		
		$articles = $this->getArticles(); /*dd($articles);*/
		if($articles)
		{
			$articles->load('user');
		}
		
		$this->content = view(env('THEME').'.admin.sitenews_content')->with('articles',$articles)->render();
		
		return $this->renderOutput();
    }
	
	public function getArticles(){
		//return $this->n_rep->get();
		return $this->n_rep->getPostsToManager();
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('save', new \Japblog\News)) {
			abort(403);
		}
		
		$this->title = "Добавить новую новость";
		
		$this->content = view(env('THEME').'.admin.sitenews_create_content')->render();
		
		return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SitenewsRequest $request)
    {
        //
		$result = $this->n_rep->addArticle($request);
		
		if(is_array($result) && !empty($result['error'])){
			return back()->with($result);
		}
		return redirect('/admin/sitenews')->with($result);
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
    public function edit(News $article)
    {
        //$article = News::where('id',$id);
		//dd($article);
		
		if(Gate::denies('edit',new News)){
			abort(403);
		}
		
		$this->title = 'Редактирование материала - '. $article->title;
		
		//dd($article);
		$this->content = view(env('THEME').'.admin.sitenews_create_content')->with(['article' => $article])->render();
		return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SitenewsRequest $request, News $article)
    {
        //
		$result = $this->n_rep->updateArticle($request, $article);
		
		if(is_array($result) && !empty($result['error'])){
			return back()->with($result);
		}
		return redirect('/admin/sitenews')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $article)
    {
        //
		$result = $this->n_rep->deleteArticle($article);
		
		if(is_array($result) && !empty($result['error'])){
			return back()->with($result);
		}
		return redirect('/admin/sitenews')->with($result);
    }
}
