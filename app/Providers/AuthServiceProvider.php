<?php

namespace Japblog\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Japblog\Posts;
use Japblog\Policies\ArticlePolicy;

use Japblog\News;
use Japblog\Policies\SitenewsPolicy;

use Japblog\Permission;
use Japblog\Policies\PermissionPolicy;

use Japblog\Menu;
use Japblog\Policies\MenusPolicy;

use Japblog\User;
use Japblog\Policies\UserDataPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Posts::class => ArticlePolicy::class,
		Permission::class => PermissionPolicy::class,
		Menu::class => MenusPolicy::class,
		News::class => SitenewsPolicy::class,
		User::class => UserDataPolicy::class
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
		
		$gate->define('VIEW_ADMIN', function($user){
			return $user->canDo('VIEW_ADMIN');
		});
		
		$gate->define('VIEW_ADMIN_ARTICLES', function($user){
			return $user->canDo('VIEW_ADMIN_ARTICLES');
		});
		
		$gate->define('EDIT_USERS', function($user){
			return $user->canDo('EDIT_USERS');
		});
		
		$gate->define('ADMIN_USERS', function($user){
			return $user->canDo('ADMIN_USERS');
		});
		
		$gate->define('VIEW_ADMIN_MENU', function($user){
			return $user->canDo('VIEW_ADMIN_MENU');
		});
		
		$gate->define('VIEW_ADMIN_SITENEWS', function($user){
			return $user->canDo('VIEW_ADMIN_SITENEWS');
		});
		
		/*user*/
		$gate->define('VIEW_USER_PAGE', function($user){
			return $user->canDo('VIEW_USER_PAGE');
		});
        //
    }
}
