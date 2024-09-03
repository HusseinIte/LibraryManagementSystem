<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Service\RatingService;
use Illuminate\Auth\Access\AuthorizationException;

/**
 * Class RatingController
 * @package App\Http\Controllers
 */
class RatingController extends Controller
{
    /**
     * @var RatingService
     */
    protected $ratingService;

    /**
     * RatingController constructor.
     * @param RatingService $ratingService
     */
    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService;
    }

    /**
     * @param StoreRatingRequest $request
     * @return \Illuminate\Http\Response
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
     * @param UpdateRatingRequest $request
     * @param Rating $rating
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        try {
            $rating = $this->ratingService->update($request, $rating);
            return $this->sendResponse($rating, 'rating has been updated successfully');
        } catch (AuthorizationException $e) {
            return $this->sendError('rating update failed', ['errors' => $e->getMessage()], 403);
        }

    }

    /**
     * @param Rating $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rating $rating)
    {
        try {
            $id = $rating->id;
            $rating = $this->ratingService->destroy($rating);
            return response()->json(['message' => 'rating with id ' . $id . ' deleted successfully.'], 200);
        } catch (AuthorizationException $e) {
            return $this->sendError('rating update failed', ['errors' => $e->getMessage()], 403);
        }

    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function showMyRating()
    {
        $ratings = $this->ratingService->showMyRating();
        return $this->sendResponse($ratings, 'your ratings has been retrieved successfully');
    }
}
