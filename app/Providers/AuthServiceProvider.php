<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Comment' => 'App\Policies\CommentPolicy',
        'App\Models\Post' => 'App\Policies\PostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->comment();
        $this->post();
        $this->admin();
        $this->permission();
        $this->role();
    }

    private function comment()
    {
        Gate::define('comment_update','App\Policies\CommentPolicy@update');

        Gate::define('comment_delete','App\Policies\CommentPolicy@delete');
    }

    private function post()
    {
        Gate::define('post_update','App\Policies\PostPolicy@update');

        Gate::define('post_delete','App\Policies\PostPolicy@delete');
    }

    private function admin()
    {
        Gate::define('admin_index',function ($user){
            return $user->checkPermission('admin_index');
        });

        Gate::define('admin_update',function ($user){
            return $user->checkPermission('admin_index');
        });
    }

    private function permission()
    {
        Gate::define('permission_index',function ($user){
            return $user->checkPermission('permission_index');
        });

        Gate::define('permission_create',function ($user){
            return $user->checkPermission('permission_create');
        });
    }

    private function role()
    {
        Gate::define('role_index',function ($user){
            return $user->checkPermission('role_index');
        });

        Gate::define('role_create',function ($user){
            return $user->checkPermission('role_create');
        });

        Gate::define('role_show',function ($user){
            return $user->checkPermission('role_show');
        });

        Gate::define('role_update',function ($user){
            return $user->checkPermission('role_update');
        });
    }
}
