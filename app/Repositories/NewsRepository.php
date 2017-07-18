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
		if(trim($data['img'])==''){$data['img']=config('settings.image_big');}
		if(trim($data['img_mini'])==''){$data['img_mini']=config('settings.image_mini');}
		
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
		
		if(trim($data['img'])==''){$data['img']=config('settings.image_big');}
		if(trim($data['img_mini'])==''){$data['img_mini']=config('settings.image_mini');}
		
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