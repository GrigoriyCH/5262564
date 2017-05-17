<?php 

namespace Japblog\Repositories;
use Japblog\News;

class NewsRepository extends Repository{
	
	public function __construct(News $news){
		$this->model = $news;
	}
	
}

?>