<?php

namespace Japblog;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //
    protected $table = 'sitenews';
	
	protected $fillable = ['title','img','img_mini','text','user_id'];
	
	public function user(){
		return( $this->belongsTo('Japblog\User'));
	}
    
    public function newscomments(){
		return $this->hasMany('Japblog\NewsComments');
	}
}