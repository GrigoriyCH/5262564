<?php 

namespace Japblog\Repositories;
use Japblog\News;

use Gate;

class NewsRepository extends Repository{
	
	public function __construct(News $news){
		$this->model = $news;
	}
	
	public function addArticle($request){
		if(Gate::denies('save',$this->model)){
			abort(403);
		}
		
		$data = $request->except('_token');
		
		if(empty($data)){
			return array('error' => 'Нет данных!');
		}
		/*
		$tmp_text = $data['text'];
		$tmp_text = preg_replace('#<span.*</span>#sUi', '', $tmp_text);
		$data['text'] = $tmp_text;
		*/
		if($data['img']==''){$data['img']='http://japblog/pink/images/articles/003-816x282.jpg';}
		if($data['img_mini']==''){$data['img']='http://japblog/pink/images/articles/003-55x55.jpg';}
		
		$this->model->fill($data);
		
		if($request->user()->sitenews()->save($this->model)){
			return ['status' => 'Новость добавлена!'];
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
			return ['status' => 'Новость обновлена!'];
		}
	}
	
	public function deleteArticle($article){
		if(Gate::denies('destroy',$article)){
			abort(403);
		}
		$article->newscomments()->delete();
		if($article->delete()){
			return ['status' => 'Новость удалена!'];
		}
	}
}

?>