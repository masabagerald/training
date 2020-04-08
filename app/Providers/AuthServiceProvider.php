<?php

namespace App\Providers;

use App\Role;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $user = \Auth::user();

        
        // Auth gates for: User management
        Gate::define('user_management_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Users
        Gate::define('user_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Designation
        Gate::define('designation_access', function ($user) {
            return in_array($user->role_id, [1,3]);
        });
        Gate::define('designation_create', function ($user) {
            return in_array($user->role_id, [1,3]);
        });
        Gate::define('designation_edit', function ($user) {
            return in_array($user->role_id, [1,3]);
        });
        Gate::define('designation_view', function ($user) {
            return in_array($user->role_id, [1,3]);
        });
        Gate::define('designation_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });



        // Auth gates for: Results
        Gate::define('result_access', function ($user) {
            return in_array($user->role_id, [1,3]);
        });
        Gate::define('result_create', function ($user) {
            return in_array($user->role_id, [1,3]);
        });
        Gate::define('result_edit', function ($user) {
            return in_array($user->role_id, [1,3]);
        });
        Gate::define('result_view', function ($user) {
            return in_array($user->role_id, [1,3]);
        });
        Gate::define('result_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Participant
        Gate::define('participant_access', function ($user) {
            return in_array($user->role_id, [1,3]);
        });
        Gate::define('participant_create', function ($user) {
            return in_array($user->role_id, [1,3]);
        });
        Gate::define('participant_edit', function ($user) {
            return in_array($user->role_id, [1,3]);
        });
        Gate::define('participant_view', function ($user) {
            return in_array($user->role_id, [1,3]);
        });
        Gate::define('participant_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Training
        Gate::define('training_access', function ($user) {
            return in_array($user->role_id, [1,3]);
        });
        Gate::define('training_create', function ($user) {
            return in_array($user->role_id, [1,3]);
        });
        Gate::define('training_edit', function ($user) {
            return in_array($user->role_id, [1,3]);
        });
        Gate::define('training_view', function ($user) {
            return in_array($user->role_id, [1,3]);
        });
        Gate::define('training_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Roles
        Gate::define('role_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

		 Gate::define('permanent_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });
		



        // Auth gates for: User actions
        Gate::define('user_action_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

    }
}
