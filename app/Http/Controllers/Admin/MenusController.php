<?php

namespace Japblog\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Japblog\Http\Requests;
use Japblog\Http\Requests\MenusRequest;
use Japblog\Http\Controllers\Controller;

use Japblog\Repositories\MenusRepository;

use Gate;
use Menu;

class MenusController extends AdminController
{
	protected $m_rep;
	
	public function __construct(MenusRepository $m_rep)
	{
		parent::__construct();
		
		if(Gate::denies('VIEW_ADMIN_MENU')){
			abort(403);
		}
		
		$this->m_rep = $m_rep;
		
		$this->template = env('THEME').'.admin.menus';
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$menu = $this->getMenus();
		
		$this->content = view(env('THEME').'.admin.menus_content')->with('menus',$menu)->render();
		return $this->renderOutput();
    }
	
	public function getMenus(){
		$menu = $this->m_rep->getM();
		
		if($menu->isEmpty()){
			return FALSE;
		}
		
		return Menu::make('forMenuPart', function($m) use($menu){
			
			foreach($menu as $item){
				if($item->parent == 0){
					$m->add($item->title,$item->path)->id($item->id);
				}
				else{
					if($m->find($item->parent)){
						$m->find($item->parent)->add($item->title,$item->path)->id($item->id);
					}
				}
			}
		});
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$this->title = 'Новый пункт меню';
		
		$tmp = $this->getMenus()->roots();
		
		$menus = $tmp->reduce(function($returnMenus, $menu){
			
			$returnMenus[$menu->id] = $menu->title;
			return $returnMenus;
			
		},['0' => 'Родительський пункт меню']);
		
		$this->content = view(env('THEME').'.admin.menus_create_content')->with(['menus'=>$menus])->render();
		return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenusRequest $request)
    {
        //
		$result = $this->m_rep->addMenu($request);
		
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
    public function edit(\Japblog\Menu $menu)
    {
        //
		$this->title = 'Редактирование пункта меню - '.$menu->title;
		
		$tmp = $this->getMenus()->roots();
		
		$menus = $tmp->reduce(function($returnMenus, $menu){
			
			$returnMenus[$menu->id] = $menu->title;
			return $returnMenus;
			
		},['0' => 'Родительський пункт меню']);
		
		$this->content = view(env('THEME').'.admin.menus_create_content')->with(['menu'=>$menu, 'menus'=>$menus])->render();
		return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, \Japblog\Menu $menu)
    {
        //
		$result = $this->m_rep->updateMenu($request, $menu);
		
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
    public function destroy(\Japblog\Menu $menu)
    {
        //
		$result = $this->m_rep->deleteMenu($menu);
		
		if(is_array($result) && !empty($result['error'])){
			return back()->with($result);
		}
		return redirect('/admin')->with($result);
    }
}
