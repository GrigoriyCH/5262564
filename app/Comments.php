<?php

namespace Japblog;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    //
    protected $table = 'comments';
    //
    
    protected $fillable = ['name','text','site','user_id','post_id','parent_id','email','to_user_id'];
    
    public function posts(){
		return $this->belongsTo('Japblog\Posts');
	}
	
	public function user(){
		return $this->belongsTo('Japblog\User');
	}
}
