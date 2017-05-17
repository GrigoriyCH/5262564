<?php 

namespace Japblog\Repositories;
use Japblog\Slider;

class SlidersRepository extends Repository{
	
	public function __construct(Slider $slider){
		$this->model = $slider;
	}
	
}

?>