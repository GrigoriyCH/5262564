<?php

namespace Japblog\Http\Controllers\User;

use Illuminate\Http\Request;

//use Japblog\Http\Requests;
use Japblog\Http\Requests\ArticleRequest;

use Japblog\Http\Controllers\Controller;

use Japblog\Repositories\PostsRepository;

use Gate;
use Japblog\Category;
use Japblog\Posts;

class PostController extends UserController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function __construct(PostsRepository $p_rep){
		
		parent::__construct(new \Japblog\Repositories\MenusRepository(new \Japblog\Menu));
		
		if(Gate::denies('VIEW_USER_PAGE')){
			abort(403);
		}
		
		$this->p_rep = $p_rep;
		
		$this->template = env('THEME').'.user.articles';
	}
	
    public function index()
    {
        return redirect('/user');
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
		
		$content = view(env('THEME').'.user.articles_create_content')->with('categories', $lists)->render();
		$this->vars = array_add($this->vars,'content',$content);
		
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
		$result = $this->p_rep->addArticle($request);
		
		if(is_array($result) && !empty($result['error'])){
			return back()->with($result);
		}
		return redirect('/user')->with($result);
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
		$content = view(env('THEME').'.user.articles_create_content')->with(['categories' => $lists,'article' => $article])->render();
		$this->vars = array_add($this->vars,'content',$content);
		
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
		return redirect('/user')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $article)
    {
        //
		$result = $this->p_rep->deleteArticle($article);
		
		if(is_array($result) && !empty($result['error'])){
			return back()->with($result);
		}
		return redirect('/user')->with($result);
    }
}
