<?php

namespace App\Providers;

use App\Models\BorrowRecord;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Gate::define('return-book', function (User $user, BorrowRecord $borrowRecord) {
            return $user->id === $borrowRecord->user_id;
        });

    }
}
