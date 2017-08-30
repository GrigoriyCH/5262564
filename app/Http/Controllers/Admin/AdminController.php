<?php

namespace Japblog\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Japblog\Http\Requests;

use Japblog\Http\Controllers\Controller;

use Auth;

use Menu;

use Gate;

class AdminController extends Controller
{
    //
	protected $n_rep;
	protected $p_rep;
	protected $user;
	protected $template;
	protected $content = FALSE;
	protected $title;
	protected $vars;
	
	public function __construct(){
		
		$this->user = Auth::user();
		
		if(!$this->user){
			abort(403);
		}
	}
	
	public function renderOutput(){
		$this->vars = array_add($this->vars,'title',$this->title);
		
		$menu = $this->getMenu();
		/* 
		$content = view(config('settings.theme').'.admin.content')->render();
        $this->vars = array_add($this->vars,'content',$content);
		*/
		$navigation = view(config('settings.theme').'.admin.navigation')->with('menu',$menu)->render();
		$this->vars = array_add($this->vars,'navigation',$navigation);
		
		if($this->content){
			$this->vars = array_add($this->vars,'content',$this->content);
		}
		
		$footer = view(config('settings.theme').'.admin.footer')->render();
		$this->vars = array_add($this->vars,'footer',$footer);
		
		return view($this->template)->with($this->vars);
	}
	
	public function getMenu(){
		return Menu::make('adminMenu', function($menu){
			
			if(Gate::allows('VIEW_ADMIN_ARTICLES')){
				$menu->add('Посты',array('route'=>'admin.posts.index'));
			}
			if(Gate::allows('VIEW_ADMIN_SITENEWS')){
				$menu->add('Новости сайта',array('route'=>'admin.sitenews.index'));
			}
			if(Gate::allows('VIEW_ADMIN_MENU')){
				$menu->add('Меню',array('route'=>'admin.menus.index'));
			}
			if(Gate::allows('ADMIN_USERS')){
				$menu->add('Пользователи',array('route'=>'admin.users.index'));
			}
			if(Gate::allows('EDIT_USERS')){	
				$menu->add('Привелегии',array('route'=>'admin.permissions.index'));
			}
		});
	}
}
