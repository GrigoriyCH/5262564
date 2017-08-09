<?php

namespace Japblog\Http\Controllers\User;

use Illuminate\Http\Request;

use Japblog\Http\Requests;
use Japblog\Http\Controllers\User;

use Japblog\Repositories\PostsRepository;
use Japblog\Repositories\CommentsRepository;
use Japblog\Repositories\UsersRepository;

use Config;
use Auth;
use Gate;

class IndexController extends UserController
{
    //
	protected $user;
	
	public function __construct(CommentsRepository $c_rep, PostsRepository $p_rep, UsersRepository $u_rep){
		
		parent::__construct(new \Japblog\Repositories\MenusRepository(new \Japblog\Menu));
		
		$this->user = Auth::user();
		
		if(!$this->user){
			abort(403);
		}
		
		if(Gate::denies('VIEW_USER_PAGE')){
			abort(403);
		}
		
		$this->c_rep = $c_rep;
		$this->u_rep = $u_rep;
		$this->p_rep = $p_rep;
		
		$this->bar='left';
		$this->template = env('THEME').'.user.index';
		}
	
	public function index(){
		$this->title = $this->user->name;
		//dd($this->user);
		$user_post = $this->getPost($this->user->id);
		$username = $this->title;
		$user = $this->user;
		//dd($user);
		//dd($user_post);
		$content = view(env('THEME').'.user.content')->with(['user_post'=>$user_post,'username'=>$username])->render();
        $this->vars = array_add($this->vars,'content',$content);
		
		$this->contentLeftBar = view(env('THEME').'.user.contact_bar')->with(['user'=>$user])->render();
		
		return $this->renderOutput();
	}
	
	public function getPost($user_id = FALSE){
		if($user_id){
			$user_post = $this->p_rep->get(['id','title','created_at','img','text','user_id','category_id','keywords','meta_desc','view'],FALSE,TRUE,['user_id',$user_id],FALSE);
				if($user_post){
					$user_post->load('category','comments');
				}
			return $user_post;
		}
	}
	
	public function update($id){
		
	}
}
