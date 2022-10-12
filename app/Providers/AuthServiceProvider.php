<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Whether the user can edit the members of a company
        Gate::define('update-members', function (User $user, mixed $company) {
            if (! ($company instanceof Company)) {
                $company = Company::find($company);
            }

            return $user->is_admin || $user->isMemberOf($company);
        });
        // Whether the user can change the owner of a company
        Gate::define('change-owner', function (User $user, mixed $company) {
            if (! ($company instanceof Company)) {
                $company = Company::find($company);
            }

            return $user->is_admin || $user->owns($company);
        });
        // Whether the user can create new adverts in a company
        Gate::define('create-advert', function (User $user, mixed $company) {
            if (! ($company instanceof Company)) {
                $company = Company::find($company);
            }

            return $user->is_admin || $user->isMemberOf($company);
        });
    }
}
