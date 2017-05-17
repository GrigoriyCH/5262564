<?php 

namespace Japblog\Repositories;
use Japblog\Comments;

class CommentsRepository extends Repository{
	
	public function __construct(Comments $comment){
		$this->model = $comment;
	}
	
}

?>