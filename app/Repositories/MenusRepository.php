<?php 

namespace Japblog\Repositories;
use Japblog\Menu;

use Gate;

class MenusRepository extends Repository{
	
	public function __construct(Menu $menu){
		$this->model = $menu;
	}
	
	public function addMenu($request){
		if(Gate::denies('save', $this->model)){
			abort(403);
		}
		
		$data = $request->only('title','parent');
		
		if(empty($data)){
			return ['error'=>'Нет данных!'];
		}
		
		$data['path'] = $request->input('custom_link');
		
		if($this->model->fill($data)->save()){
			return ['status'=>'Новый пунк меню - успешно добавлен!'];
		}
	}
	
	public function updateMenu($request, $menu){
		if(Gate::denies('save', $this->model)){
			abort(403);
		}
		
		$data = $request->only('title','parent');
		
		if(empty($data)){
			return ['error'=>'Нет данных!'];
		}
		
		$data['path'] = $request->input('custom_link');
		
		if($menu->fill($data)->update()){
			return ['status'=>'Пунк меню - успешно обновлен!'];
		}
	}
	
	public function deleteMenu($menu){
		if(Gate::denies('save', $this->model)){
			abort(403);
		}
		if($menu->delete()){
			return ['status'=>'Пунк меню - успешно удален!'];
		}
	}
	
}

?>