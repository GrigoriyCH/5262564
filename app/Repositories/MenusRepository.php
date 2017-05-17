<?php 

namespace Japblog\Repositories;
use Japblog\Menu;

class MenusRepository extends Repository{
	
	public function __construct(Menu $menu){
		$this->model = $menu;
	}
	
}

?>