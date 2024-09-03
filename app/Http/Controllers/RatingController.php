<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Service\RatingService;
use Illuminate\Auth\Access\AuthorizationException;

class RatingController extends Controller
{
    protected $ratingService;

    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRatingRequest $request)
    {
        try {
            $rating = $this->ratingService->store($request);
            return $this->sendResponse($rating, 'The book has been rated successfully.');
        } catch (AuthorizationException $e) {
            return $this->sendError('rating failed', ['errors' => $e->getMessage()], 403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        $rating = $this->ratingService->update($request, $rating);
        return $this->sendResponse($rating, 'book has been rated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
