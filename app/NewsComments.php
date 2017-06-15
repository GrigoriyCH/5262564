<?php

namespace Japblog;

use Illuminate\Database\Eloquent\Model;

class NewsComments extends Model
{
    //
    protected $table = 'newscomments';
    //
    
    protected $fillable = ['name','text','site','user_id','post_id','parent_id','email','to_user_id'];
    
    public function sitenews(){
		return $this->belongsTo('Japblog\News');
	}
	
	public function user(){
		return $this->belongsTo('Japblog\User');
	}
}
