<?php

namespace App\Service;

use App\Exceptions\BookAlreadyBorrowedException;
use App\Exceptions\BookAlreadyReturnedException;
use App\Http\Requests\StoreBorrowRecordRequest;
use App\Models\Book;
use App\Models\BorrowRecord;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

/**
 * Class BorrowRecordService
 * @package App\Service
 */
class BorrowRecordService
{
    //
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function showMyBorrowedBook()
    {
        return BorrowRecord::with('book')
            ->where('user_id', Auth::id())
            ->get();

    }


    /**
     * @param array $data
     * @param $bookId
     * @return mixed
     * @throws BookAlreadyBorrowedException
     */
    public function borrowBook(array $data, $bookId)
    {
        if (!Book::find($bookId)) {
            throw new ModelNotFoundException('The book with the given ID was not found.');
        }
        if ($this->isBookBorrowed($bookId)) {
            throw new BookAlreadyBorrowedException('This book is already borrowed and not yet returned.');
        }
        return BorrowRecord::create([
            'user_id' => Auth::id(),
            'book_id' => $bookId,
            'borrowed_at' => !empty($data['borrowed_at']) ? $data['borrowed_at'] : Carbon::now(),
        ]);
    }

    /**
     * @param array $data
     * @param $borrowRecordId
     * @return mixed
     * @throws AuthorizationException
     * @throws BookAlreadyReturnedException
     */
    public function returnBook(array $data, $borrowRecordId)
    {
        $borrowRecord = BorrowRecord::find($borrowRecordId);
        if (!$borrowRecord) {
            throw new ModelNotFoundException('The borrow record with the given ID was not found.');
        }
        if (!Gate::allows('return-book', $borrowRecord)) {
            throw new AuthorizationException('You are not authorized to return this book');
        }
        if ($borrowRecord->due_date) {
            throw new BookAlreadyReturnedException('This book is already returned.');
        }
        $borrowRecord->due_date = !empty($data['due_date']) ? $data['due_date'] : Carbon::now();
        $borrowRecord->save();
        return $borrowRecord;
    }

    /**
     * @param $bookId
     * @return mixed
     */
    public function isBookBorrowed($bookId)
    {
        return BorrowRecord::where('book_id', $bookId)
            ->whereNull('due_date')
            ->exists();
    }
}
