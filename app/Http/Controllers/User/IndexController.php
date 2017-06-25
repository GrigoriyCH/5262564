<?php

namespace Japblog\Http\Controllers\User;

use Illuminate\Http\Request;

use Japblog\Http\Requests;
use Japblog\Http\Controllers\SiteController;

use Japblog\Repositories\PostsRepository;
use Japblog\Repositories\CommentsRepository;
use Japblog\Repositories\UsersRepository;

use Config;
use Auth;
use Gate;

class IndexController extends SiteController
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
		$this->title = 'Посты пользователя - '. $this->user->name;
		//dd($this->user);
		
		$content = view(env('THEME').'.user.content')->render();
        $this->vars = array_add($this->vars,'content',$content);
		
		$this->contentLeftBar = view(env('THEME').'.user.contact_bar')->render();
		
		return $this->renderOutput();
	}
}
