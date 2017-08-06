<?php

namespace Japblog\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use Japblog\User;

class UserDataPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
	
	public function create(User $user)
	{
		return $user->can('EDIT_USERS');
	}
	
	public function edit(User $user)
	{
		return $user->can('EDIT_USERS');
	}
	
	public function editSelf(User $user, User $useredit) 
	{
		return ($user->canDo('UPDATE_USER') && $user->id == $useredit->id);
	}
}
