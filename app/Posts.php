<?php

namespace Japblog;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'posts';
	
	protected $fillable = ['title','img','text','keywords','meta_desc','category_id','user_id','view'];
    
    public function user(){
		return( $this->belongsTo('Japblog\User'));
	}
	
	public function category(){
		return( $this->belongsTo('Japblog\Category'));
	}
    
    public function comments(){
		return $this->hasMany('Japblog\Comments');
	}
}
