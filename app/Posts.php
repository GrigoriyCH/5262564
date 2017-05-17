<?php

namespace Japblog;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'posts';
    
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
