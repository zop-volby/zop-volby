<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Election;
use App\Models\ElectionPhases;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('admin', function ($user) {
            return $user->is_admin;
        });
        Gate::define('preparation', function ($user = null) {
            return Election::find(1)->phase == ElectionPhases::PREPARATION;
        });
        Gate::define('digital-voting', function ($user = null) {
            return Election::find(1)->phase == ElectionPhases::DIGITAL_VOTING;
        });
        Gate::define('mail-voting', function ($user = null) {
            return Election::find(1)->phase == ElectionPhases::MAIL_VOTING;
        });
        Gate::define('inperson-voting', function ($user = null) {
            return Election::find(1)->phase == ElectionPhases::INPERSON_VOTING;
        });
        Gate::define('result-processing', function ($user = null) {
            return Election::find(1)->phase == ElectionPhases::RESULT_PROCESSING;
        });
        Gate::define('finished', function ($user = null) {
            return Election::find(1)->phase == ElectionPhases::FINISHED;
        });
    }
}
