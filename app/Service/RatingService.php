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

class RatingService
{
    /**
     * Display a listing of the resource.
     * @param StoreRatingRequest $request
     */

    public function store(StoreRatingRequest $request)
    {
        $borrowRecord = BorrowRecord::where('book_id', $request->book_id)
            ->where('user_id', Auth::id())->exists();
        if (!$borrowRecord) {
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
     * Display the specified resource.
     * @param Rating $rating
     */

    public function showByBook(Rating $rating)
    {
        //
    }

    public function showByUser(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateRatingRequest $request
     * @param $id
     */
    public
    function update(UpdateRatingRequest $request, $rating)
    {
        $validated = $request->validated();
        $rating->update($validated);
        return $rating;
    }

    /**
     * Remove the specified resource from storage.
     */
    public
    function destroy(Rating $rating)
    {
        //
    }
}
