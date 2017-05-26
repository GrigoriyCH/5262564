<?php

namespace Japblog\Http\Controllers\Admin;

use Illuminate\Http\Request;

//use Japblog\Http\Requests;
use Japblog\Http\Requests\ArticleRequest;

use Japblog\Http\Controllers\Controller;

use Japblog\Repositories\PostsRepository;

use Gate;
use Japblog\Category;
use Japblog\Posts;

class PostsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function __construct(PostsRepository $p_rep){
		
		parent::__construct();
		
		if(Gate::denies('VIEW_ADMIN_ARTICLES')){
			abort(403);
		}
		
		$this->p_rep = $p_rep;
		
		$this->template = env('THEME').'.admin.articles';
	}
	
    public function index()
    {
        //
		$this->title = 'Менеджер постов';
		
		$articles = $this->getArticles(); /*dd($articles);*/
		if($articles)
		{
			$articles->load('user','category');
		}
		
		$this->content = view(env('THEME').'.admin.articles_content')->with('articles',$articles)->render();
		
		return $this->renderOutput();
    }
	
	public function getArticles(){
		//return $this->p_rep->get();
		return $this->p_rep->getPostsToManager();
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('save', new \Japblog\Posts)) {
			abort(403);
		}
		
		$this->title = "Добавить новый материал";
		
		$categories = Category::select(['title','alias','parentid','id'])->get();
		
		$lists['Категории'] = array();
		/*$lists['Категории']['1'] = 'Новости аниме';
		$lists['Категории']['2'] = 'Новости манги';*/
		
		foreach($categories as $category){
			$lists['Категории'][$category->id] = $category->title;
		}
		
		$this->content = view(env('THEME').'.admin.articles_create_content')->with('categories', $lists)->render();
		
		return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        //
		$result = $this->p_rep->addArticle($request);
		
		if(is_array($result) && !empty($result['error'])){
			return back()->with($result);
		}
		return redirect('/admin')->with($result);
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
    public function edit(Posts $article)
    {
        //$article = Posts::where('id',$id);
		//dd($article);
		
		if(Gate::denies('edit',new Posts)){
			abort(403);
		}
		
		$this->title = 'Редактирование материала - '. $article->title;
		
		$categories = Category::select(['title','alias','parentid','id'])->get();
		
		$lists['Категории'] = array();
		
		foreach($categories as $category){
			$lists['Категории'][$category->id] = $category->title;
		}
		//dd($article);
		$this->content = view(env('THEME').'.admin.articles_create_content')->with(['categories' => $lists,'article' => $article])->render();
		return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Posts $article)
    {
        //
		$result = $this->p_rep->updateArticle($request, $article);
		
		if(is_array($result) && !empty($result['error'])){
			return back()->with($result);
		}
		return redirect('/admin')->with($result);
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
