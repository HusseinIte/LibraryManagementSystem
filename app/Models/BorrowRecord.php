<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class BorrowRecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_at',
        'due_date',
        'returned_at'
    ];

    protected static function booted()
    {
        static::creating(function ($borrowRecord) {
            if (empty($borrowRecord->returned_at)) {
                $borrowRecord->returned_at = Carbon::parse($borrowRecord->borrowed_at)->addDays(14);
            }
        });
    }
}
