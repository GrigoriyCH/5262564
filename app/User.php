<?php

namespace Japblog;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login','name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function articles(){
		return $this->hasMany('Japblog\Posts');
	}
    
	public function roles(){
		return $this->belongsToMany('Japblog\Role','role_user');
	}
	
	public function canDo($permission, $require = FALSE){
		if(is_array($permission)){
			foreach($permission as $permName){
				$permName = $this->canDo($permName);
				if($permName && !$require){
					return TRUE;
				}
				else if(!$permName && $require){
					return FALSE;
				}
			}
			return $require;
		}
		else{
			foreach($this->roles as $role){
				foreach($role->permissions()->get() as $perm){
					if(str_is($permission,$perm->name)){
						return TRUE;
					}
				}
			}
		}
	}
	
	public function hasRole($name, $require = FALSE){
		if(is_array($name)){
			foreach($name as $roleName){
				$hasRole = $this->hasRole($roleName);
				if($hasRole && !$require){
					return TRUE;
				}
				else if(!$hasRole && $require){
					return FALSE;
				}
			}
			return $require;
		}
		else{
			foreach($this->roles as $role){
				if($role->name == $name){
					return TRUE;
				}
			}
		}
	}
}
