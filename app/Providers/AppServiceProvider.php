<?php

namespace App\Providers;

use App\Models\BorrowRecord;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
            return $user->id == $borrowRecord->user_id;
        });

        Gate::define('rating-book', function (User $user, $request) {
            return BorrowRecord::where('book_id', $request->book_id)
                ->where('user_id', Auth::id())->exists();
        });

        Gate::define('updateRating-book', function (User $user, $rating) {
            return $user->id == $rating->user_id;
        });

        Gate::define('deleteRating-book', function (User $user, $rating) {
            return $user->id == $rating->user_id;
        });

    }
}
