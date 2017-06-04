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
	
}

?>