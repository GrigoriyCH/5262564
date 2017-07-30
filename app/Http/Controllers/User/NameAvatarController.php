<?php

namespace Japblog\Http\Controllers\User;

use Illuminate\Http\Request;

//use Japblog\Http\Requests;
use Japblog\Http\Requests\NameAvatarRequest;

use Japblog\Http\Controllers\Controller;

use Japblog\User;
use Japblog\Repositories\UsersRepository;

use Gate;

class NameAvatarController extends UserController
{
	public function __construct(UsersRepository $u_rep){
		if(Gate::denies('VIEW_USER_PAGE')){
			abort(403);
		}
		
		$this->u_rep = $u_rep;
	}
	
    public function update(NameAvatarRequest $request, User $useredit)
    {	//dd($request);
		$result = $this->u_rep->updateSelf($request, $useredit);
		
		if(is_array($result) && !empty($result['error'])){
			return redirect('/user')->with($result);
		}
		return redirect('/user')->with($result);
    }
}
