<?php

namespace App\Service;

use App\Exceptions\BookAlreadyBorrowedException;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Models\Book;
use App\Models\BorrowRecord;
use App\Models\Rating;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

/**
 * Class RatingService
 * @package App\Service
 */
class RatingService
{

    /**
     * @param StoreRatingRequest $request
     * @return mixed
     * @throws AuthorizationException
     */
    public function store(StoreRatingRequest $request)
    {
        if (!Gate::allows('rating-book', $request)) {
            throw new AuthorizationException('You are not authorized to rating this book');
        }
        $validated = $request->validated();
        $rating = Rating::create([
            'user_id' => Auth::id(),
            'book_id' => $validated['book_id'],
            'rating' => $validated['rating'],
            'review' => isset($validated['review']) ? $validated['review'] : null
        ]);

        return $rating->with('book')->get();
    }


    /**
     * @param UpdateRatingRequest $request
     * @param $rating
     * @return mixed
     * @throws AuthorizationException
     */
    public function update(UpdateRatingRequest $request, $rating)
    {
        if (!Gate::allows('updateRating-book', $rating)) {
            throw new AuthorizationException('You are not authorized to update rating this book');
        }
        $validated = $request->validated();
        $rating->update($validated);
        return $rating;
    }

    /**
     * @param Rating $rating
     * @return bool|null
     * @throws AuthorizationException
     */
    public function destroy(Rating $rating)
    {
        if (!Gate::allows('deleteRating-book', $rating)) {
            throw new AuthorizationException('You are not authorized to delete rating this book');
        }
        return $rating->delete();
    }

    /**
     * @return mixed
     */
    public function showMyRating()
    {
        $user = Auth::user();
        return $user->ratings;
    }
}
