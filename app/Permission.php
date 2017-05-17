<?php

namespace Japblog;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //
	public function roles(){
		return $this->belongsToMany('Japblog\Role','permission_role');
	}
}
