<?php

namespace App\Http\Controllers;

use App\Exceptions\BookAlreadyBorrowedException;
use App\Exceptions\BookAlreadyReturnedException;
use App\Http\Requests\ReturnBookFormRequest;
use App\Models\BorrowRecord;
use App\Http\Requests\StoreBorrowRecordRequest;
use App\Http\Requests\UpdateBorrowRecordRequest;
use App\Service\BorrowRecordService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class BorrowRecordController
 * @package App\Http\Controllers
 */
class BorrowRecordController extends Controller
{
    /**
     * @var BorrowRecordService
     */
    protected $borrowRecordService;

    /**
     * BorrowRecordController constructor.
     * @param BorrowRecordService $borrowRecordService
     */
    public function __construct(BorrowRecordService $borrowRecordService)
    {
        $this->borrowRecordService = $borrowRecordService;
    }

    /**
     * @param StoreBorrowRecordRequest $request
     * @param $bookId
     * @return \Illuminate\Http\Response
     */
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

    /**
     * @param ReturnBookFormRequest $request
     * @param $borrowRecordId
     * @return \Illuminate\Http\Response
     */
    public function returnBook(ReturnBookFormRequest $request, $borrowRecordId)
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
     * @return \Illuminate\Http\Response
     */
    public function showMyBorrowedBook()
    {
        $borrowedUser = $this->borrowRecordService->showMyBorrowedBook();
        return $this->sendResponse($borrowedUser, 'your borrowed book has been retrieved successfully');
    }
}
