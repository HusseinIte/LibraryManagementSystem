<?php

namespace App\Service;

use App\Exceptions\BookAlreadyBorrowedException;
use App\Exceptions\BookAlreadyReturnedException;
use App\Http\Requests\StoreBorrowRecordRequest;
use App\Models\Book;
use App\Models\BorrowRecord;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class BorrowRecordService
{
    //
    public function index()
    {
        return BorrowRecord::with('book')
            ->where('user_id', Auth::id())
            ->get();

    }


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

    public function returnBook(array $data, $borrowRecordId)
    {
        $borrowRecord = BorrowRecord::find($borrowRecordId);
        if (!$borrowRecord) {
            throw new ModelNotFoundException('The borrow record with the given ID was not found.');
        }
        if ($borrowRecord->due_date) {
            throw new BookAlreadyReturnedException('This book is already returned.');
        }
        $borrowRecord->due_date = !empty($data['due_date']) ? $data['due_date'] : Carbon::now();
        $borrowRecord->save();
        return $borrowRecord;
    }

    public function isBookBorrowed($bookId)
    {
        return BorrowRecord::where('book_id', $bookId)
            ->whereNull('due_date')
            ->exists();
    }
}
