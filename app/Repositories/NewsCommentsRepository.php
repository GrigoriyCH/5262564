<?php 

namespace Japblog\Repositories;
use Japblog\NewsComments;

class NewsCommentsRepository extends Repository{
	
	public function __construct(NewsComments $newscomment){
		$this->model = $newscomment;
	}
	
}

?>