<?php

namespace Japblog\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Japblog\Posts;
use Japblog\Policies\ArticlePolicy;

use Japblog\Permission;
use Japblog\Policies\PermissionPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Posts::class => ArticlePolicy::class,
		Permission::class => PermissionPolicy::class
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

        //
    }
}
