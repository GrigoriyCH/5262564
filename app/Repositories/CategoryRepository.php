<?php 

namespace Japblog\Repositories;
use Japblog\Category;

class CategoryRepository extends Repository{
	
	public function __construct(Category $category){
		$this->model = $category;
	}
	
}

?>