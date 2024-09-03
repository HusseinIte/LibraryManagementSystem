<?php

namespace App\Service;

use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Models\Rating;

class RatingService
{
    /**
     * Display a listing of the resource.
     * @param StoreRatingRequest $request
     */

    public function store(StoreRatingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * @param Rating $rating
     */
    public function showById(Rating $rating)
    {
        //
    }

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
    public function update(UpdateRatingRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
