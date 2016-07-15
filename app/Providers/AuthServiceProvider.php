<?php

namespace App\Providers;

use App\Extending\SHA1Hasher;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
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
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate $gate
     * @param SHA1Hasher $hasher
     */
    public function boot(GateContract $gate, SHA1Hasher $hasher)
    {
        \Auth::provider('trinitycore', function($app) use($hasher)
        {
            return new TrinityCoreUserProvider($hasher, config("auth.providers.users.model"));
        });

        $this->registerPolicies($gate);

        //
    }
}
