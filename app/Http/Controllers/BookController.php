<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Service\BookService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index(Request $request)
    {
        $books = $this->bookService->index($request);
        return $this->sendResponse(BookResource::collection($books), 'successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $book = $this->bookService->storeBook($request->all());
        return $this->sendResponse($book, 'The book has been added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $book = $this->bookService->showBookById($id);
            return $this->sendResponse($book, 'Book retrieved successfully.');

        } catch (ModelNotFoundException $e) {
            return $this->sendError('book not found', ['error' => $e->getMessage()], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, $id)
    {
        try {
            $book = $this->bookService->updateBook($request->all(), $id);
            return $this->sendResponse($book, 'The book has been updated successfully.');

        } catch (ModelNotFoundException $e) {
            return $this->sendError('book not found', ['error' => $e->getMessage()], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->bookService->deleteBook($id);
            return response()->json(['message' => 'Book with id ' . $id . ' deleted successfully.'], 200);
        } catch (ModelNotFoundException $e) {
            return $this->sendError('book not found', ['error' => $e->getMessage()], 404);
        }
    }
}
