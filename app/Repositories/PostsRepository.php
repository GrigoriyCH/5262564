<?php 

namespace Japblog\Repositories;
use Japblog\Posts;
use Japblog\Category;
use Japblog\Keywords;
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
		
		$tmp_text = strip_tags($data['text']);
		
		$data['title'] = trim($data['title']);
		if(trim($data['img'])==''){$data['img']=config('settings.image_big');}
		if(trim($data['keywords'])==''){$genKeys = new Keywords();
										$data['keywords'] = $genKeys->seokeywords($tmp_text,5,7);}
		$data['meta_desc'] = str_limit($tmp_text, 250);
		
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
		
		$tmp_text = strip_tags($data['text']);
		
		$data['title'] = trim($data['title']);
		if(trim($data['img'])==''){$data['img']=config('settings.image_big');}
		if(trim($data['keywords'])==''){$genKeys = new Keywords();
										$data['keywords'] = $genKeys->seokeywords($tmp_text,5,7);}
		$data['meta_desc'] = str_limit($tmp_text, 250);
		
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
		if(Gate::denies('editOwn',$article)){
			abort(403);
		}
		
		$data = $request->except('_token','_method');
		
		if(empty($data)){
			return array('error' => 'Нет данных!');
		}
		
		$tmp_text = strip_tags($data['text']);
		
		$data['title'] = trim($data['title']);
		if(trim($data['img'])==''){$data['img']=config('settings.image_big');}
		if(trim($data['keywords'])==''){$genKeys = new Keywords();
										$data['keywords'] = $genKeys->seokeywords($tmp_text,5,7);}
		$data['meta_desc'] = str_limit($tmp_text, 250);
		
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