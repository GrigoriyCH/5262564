<?php

namespace Japblog\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use Japblog\User;

class ArticlePolicy
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
		return $user->canDo('ADD_ARTICLES');
	}
}
