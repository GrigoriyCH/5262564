<?php

namespace Japblog;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
	public function users(){
		return $this->belongsToMany('Japblog\User','role_user');
	}
	
	public function permissions(){
		return $this->belongsToMany('Japblog\Permission','permission_role');
	}
}
