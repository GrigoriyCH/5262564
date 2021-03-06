<?php 

namespace Japblog\Repositories;
use Config;

abstract class Repository {
	
	protected $model = FALSE;
	
	public function get($select = '*',$take = FALSE,$pagination = FALSE,$where = FALSE, $randomsort = FALSE){
		
		$builder = $this->model->select($select);
		
		if ($take){
			$builder->take($take);
		}
		
		if($where){
			$builder->where($where[0],$where[1]);
		}
		
		if(!$randomsort){
			$builder->orderBy('created_at','desc');
		}
		else{
			$builder->inRandomOrder();
		}
		
		if($pagination){
			return $this->check($builder->paginate(Config::get('settings.paginate')));
		}
		
		return $this->check($builder->get());
		
		
	}
	
	public function getRssAn($select = '*',$take = FALSE,$where){
		
		$builder = $this->model->select($select);
		
		if ($take){
			$builder->take($take);
		}
		
		$builder->where($where,1)->orWhere($where,3)->orWhere($where,6)->orWhere($where,9);
		
		$builder->orderBy('created_at','desc');
		
		return $this->check($builder->get());
		
		
	}
	public function getRssTv($select = '*',$take = FALSE,$where){
		
		$builder = $this->model->select($select);
		
		if ($take){
			$builder->take($take);
		}
		
		$builder->where($where,2)->orWhere($where,5)->orWhere($where,7)->orWhere($where,8);
		
		$builder->orderBy('created_at','desc');
		
		return $this->check($builder->get());
		
		
	}
	
	public function getFind($select = '*',$key = FALSE, $randomsort = FALSE){
		
		$builder = $this->model->select($select);
		
		if($key){
			$builder->where('title','LIKE',"%".$key."%");
		}
		
		if(!$randomsort){
			$builder->orderBy('created_at','desc');
		}
		else{
			$builder->inRandomOrder();
		}
		
		return $this->check($builder->paginate(Config::get('settings.search_paginate')));

	}
	
	public function get2($select = '*',$skip = FALSE,$take = FALSE,$pagination = FALSE,$where = FALSE, $randomsort = FALSE){
		
		$builder = $this->model->select($select);
		
		if($skip){
			$builder->skip($skip);
		}
		
		if ($take){
			$builder->take($take);
		}
		
		if($where){
			$builder->where($where[0],$where[1]);
		}
		
		if(!$randomsort){
			$builder->orderBy('created_at','asc');
		}
		else{
			$builder->inRandomOrder();
		}
		
		if($pagination){
			return $this->check($builder->paginate(Config::get('settings.paginate')));
		}
		
		return $this->check($builder->get());
		
		
	}
	public function get3($select = '*',$take = FALSE,$pagination = FALSE,$whereIn = FALSE, $randomsort = FALSE){
		
		$builder = $this->model->select($select);
		
		if ($take){
			$builder->take($take);
		}
		
		if($whereIn){
			$builder->whereIn($whereIn[0],$whereIn[1]);
		}
		
		if(!$randomsort){
			$builder->orderBy('created_at','desc');
		}
		else{
			$builder->inRandomOrder();
		}
		
		if($pagination){
			return $this->check($builder->paginate(Config::get('settings.paginate')));
		}
		
		return $this->check($builder->get());
		
		
	}
	public function getM($select = '*',$take = FALSE,$pagination = FALSE,$where = FALSE){
		
		$builder = $this->model->select($select);
		
		if ($take){
			$builder->take($take);
		}
		
		if($where){
			$builder->where($where[0],$where[1]);
		}
		
		if($pagination){
			return $this->check($builder->paginate(Config::get('settings.paginate')));
		}
		
		return $this->check($builder->get());
		
		
	}
	
	public function getPostsToManager($select = '*',$pagination = TRUE,$randomsort = FALSE){
		
		$builder = $this->model->select($select);
		
		if(!$randomsort){
			$builder->orderBy('id','desc');
		}
		
		if($pagination){
			return $this->check($builder->paginate(Config::get('settings.paginate_posts_manager')));
		}
		
		return $this->check($builder->get());
			
	}
	
	protected function check($result){
		
		if($result->isEmpty()){
			return FALSE;
		}
		
		$result->transform(function($item,$key){
			
			if(is_string($item->img) && (is_object(json_decode($item->img))) && (json_last_error() == JSON_ERROR_NONE)){
				
			$item->img = json_decode($item->img);
			
			}
			return $item;
			
		});
		
		return $result;
		
	}
	
	public function one($id){
		
		$result = $this->model->where('id',$id)->first();
		return $result;
	}
	
	public function oneUserID($id){
		
		$result = $this->model->select('user_id')->where('id',$id)->first();
		return $result;
	}
	
}

?>