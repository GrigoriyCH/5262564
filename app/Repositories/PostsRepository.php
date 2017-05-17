<?php 

namespace Japblog\Repositories;
use Japblog\Posts;

class PostsRepository extends Repository{
	
	public function __construct(Posts $posts){
		$this->model = $posts;
	}
	public function one($id,$attr = array()){
		$article = parent::one($id,$attr);
		
		if($article && !empty($attr)){
			$article->load('comments');
			$article->comments->load('user');
		}
		return $article;
	}
	public function addArticle($request){
		if(Gate::denies('save',$this->model)){
			abort(403);
		}
		
		$data = $request->except('_token');
		
		if(empty($data)){
			return array('error' => 'Нет данных!');
		}
	}
}

?>