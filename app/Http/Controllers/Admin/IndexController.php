<?php

namespace Japblog\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Japblog\Http\Requests;
use Japblog\Http\Controllers\Controller;

use Gate;

class IndexController extends AdminController
{
    //
	public function __construct(){
		
		parent::__construct();
		
		if(Gate::denies('VIEW_ADMIN')){
			abort(403);
		}
		
		$this->template = config('settings.theme').'.admin.index';
	}
	
	public function index(){
		$this->title = 'Панель администратора';
		return $this->renderOutput();
		/*return redirect('/admin/posts');*/
	}
}
