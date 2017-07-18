<?php 

namespace Japblog\Repositories;
use Japblog\Posts;

use Gate;

class PostsRepository extends Repository{
	
	public function __construct(Posts $posts){
		$this->model = $posts;
	}/*
	public function one($id,$attr = array()){
		$article = parent::one($id,$attr);
		
		if($article && !empty($attr)){
			$article->load('comments');
			$article->comments->load('user');
		}
		return $article;
	}*/
	public function addArticle($request){
		if(Gate::denies('save',$this->model)){
			abort(403);
		}
		
		$data = $request->except('_token');
		
		if(empty($data)){
			return array('error' => 'Нет данных!');
		}
		
		if(trim($data['img'])==''){$data['img']=config('settings.image_big');}
		if(trim($data['img_mini'])==''){$data['img_mini']=config('settings.image_mini');}
		
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
		
		if(trim($data['img'])==''){$data['img']=config('settings.image_big');}
		if(trim($data['img_mini'])==''){$data['img']=config('settings.image_mini');}
		
		$article->fill($data);
		
		if($article->update()){
			return ['status' => 'Пост обновлен!'];
		}
	}
	
	public function deleteArticle($article){
		if(Gate::denies('destroy',$article)){
			abort(403);
		}
		$article->comments()->delete();
		if($article->delete()){
			return ['status' => 'Пост удален!'];
		}
	}
	
	/*work with owns*/
	public function updateArticleOwn($request, $article){
		if(Gate::denies('editOwn',$this->model)){
			abort(403);
		}
		
		$data = $request->except('_token','_method');
		
		if(empty($data)){
			return array('error' => 'Нет данных!');
		}
		
		if(trim($data['img'])==''){$data['img']=config('settings.image_big');}
		if(trim($data['img_mini'])==''){$data['img']=config('settings.image_mini');}
		
		$article->fill($data);
		
		if($article->update()){
			return ['status' => 'Пост обновлен!'];
		}
	}
	
	public function deleteArticleOwn($article){
		if(Gate::denies('destroyOwn',$article)){
			abort(403);
		}
		$article->comments()->delete();
		if($article->delete()){
			return ['status' => 'Пост удален!'];
		}
	}
}

?>