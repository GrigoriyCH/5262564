<?php

namespace Japblog\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Japblog\Http\Requests;
use Japblog\Http\Controllers\Controller;

use Auth;

use Menu;

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
		$content = view(env('THEME').'.admin.content')->render();
        $this->vars = array_add($this->vars,'content',$content);
		*/
		$navigation = view(env('THEME').'.admin.navigation')->with('menu',$menu)->render();
		$this->vars = array_add($this->vars,'navigation',$navigation);
		
		if($this->content){
			$this->vars = array_add($this->vars,'content',$this->content);
		}
		
		$footer = view(env('THEME').'.admin.footer')->render();
		$this->vars = array_add($this->vars,'footer',$footer);
		
		return view($this->template)->with($this->vars);
	}
	
	public function getMenu(){
		return Menu::make('adminMenu', function($menu){
			$menu->add('Посты',array('route'=>'admin.posts.index'));
			
			$menu->add('Новости сайта',array('route'=>'admin.sitenews.index'));
			$menu->add('Меню',array('route'=>'admin.menus.index'));
			$menu->add('Пользователи',array('route'=>'admin.users.index'));
			$menu->add('Привелегии',array('route'=>'admin.permissions.index'));
		});
	}
}
