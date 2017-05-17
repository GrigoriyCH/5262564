<?php

namespace Japblog;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function posts(){
		return $this->hasMany('Japblog\Posts');
	}
}
