<?php

namespace App\Http\Controllers;

use App\Exceptions\BookAlreadyBorrowedException;
use App\Exceptions\BookAlreadyReturnedException;
use App\Models\BorrowRecord;
use App\Http\Requests\StoreBorrowRecordRequest;
use App\Http\Requests\UpdateBorrowRecordRequest;
use App\Service\BorrowRecordService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BorrowRecordController extends Controller
{
    protected $borrowRecordService;

    public function __construct(BorrowRecordService $borrowRecordService)
    {
        $this->borrowRecordService = $borrowRecordService;
    }

    public function borrowBook(StoreBorrowRecordRequest $request, $bookId)
    {
        try {
            $record = $this->borrowRecordService->borrowBook($request->all(), $bookId);
            return $this->sendResponse($record, 'Book borrowed successfully!');
        } catch (BookAlreadyBorrowedException $e) {
            return $this->sendError('Book borrowing failed', ['error' => $e->getMessage()], 400);
        } catch (ModelNotFoundException $e) {
            return $this->sendError('book not found', ['error' => $e->getMessage()], 404);
        }
    }

    public function returnBook(UpdateBorrowRecordRequest $request, $borrowRecordId)
    {
        try {
            $record = $this->borrowRecordService->returnBook($request->all(), $borrowRecordId);
            return $this->sendResponse($record, 'Book returned successfully!');
        } catch (ModelNotFoundException $e) {
            return $this->sendError('Borrow record not found', ['error' => $e->getMessage()], 404);
        } catch (AuthorizationException $e) {
            return $this->sendError('Unauthorized action', ['error' => $e->getMessage()], 403);
        } catch (BookAlreadyReturnedException $e) {
            return $this->sendError('Book return failed', ['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBorrowRecordRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BorrowRecord $borrowRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBorrowRecordRequest $request, BorrowRecord $borrowRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BorrowRecord $borrowRecord)
    {
        //
    }
}
