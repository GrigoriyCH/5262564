<?php

namespace Japblog\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use Japblog\User;

class SitenewsPolicy
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
	public function save(User $user) 
	{
		return $user->canDo('ADD_SITENEWS');
	}
	
	public function edit(User $user) 
	{
		return $user->canDo('UPDATE_SITENEWS');
	}
	
	public function destroy(User $user) 
	{
		return $user->canDo('DELETE_SITENEWS');
	}
}
