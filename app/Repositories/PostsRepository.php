<?php 

namespace Japblog\Repositories;
use Japblog\Posts;

use Gate;

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
		
		if($data['img']==''){$data['img']='http://japblog/pink/images/articles/003-816x282.jpg';}
		if($data['img_mini']==''){$data['img']='http://japblog/pink/images/articles/003-55x55.jpg';}
		
		$this->model->fill($data);
		
		if($request->user()->articles()->save($this->model)){
			return ['status' => 'Пост добавлен!'];
		}
	}
	
	public function updateArticle($request, $article){
		if(Gate::denies('edit',$this->model)){
			abort(403);
		}
		
		$data = $request->except('_token','_method');
		
		if(empty($data)){
			return array('error' => 'Нет данных!');
		}
		
		if($data['img']==''){$data['img']='http://japblog/pink/images/articles/003-816x282.jpg';}
		if($data['img_mini']==''){$data['img']='http://japblog/pink/images/articles/003-55x55.jpg';}
		
		$article->fill($data);
		
		if($article->update()){
			return ['status' => 'Пост обновлен!'];
		}
	}
}

?>