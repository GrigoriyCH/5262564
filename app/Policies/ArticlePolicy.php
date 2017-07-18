<?php

namespace Japblog\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use Japblog\User;
use Japblog\Posts;

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
	
	public function edit(User $user) 
	{
		return $user->canDo('UPDATE_ARTICLES');
	}
	
	public function destroy(User $user) 
	{
		return $user->canDo('DELETE_ARTICLES');
	}
	/*work with owns*/
	public function editOwn(User $user, Posts $article) 
	{
		return ($user->canDo('UPDATE_ARTICLES') && $user->id == $article->user_id);
	}
	
	public function destroyOwn(User $user, Posts $article) 
	{
		return ($user->canDo('DELETE_ARTICLES') && $user->id == $article->user_id);
	}
}
