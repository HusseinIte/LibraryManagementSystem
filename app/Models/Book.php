<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'published_at',
        'category_id'

    ];

    public function borrowRecords()
    {
        return $this->hasMany(BorrowRecord::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function scopeNotBorrowedBook($query)
    {

        return $query->whereDoesntHave('borrowRecords', function ($query) {
            $query->whereNull('due_date');
        });
    }

    public function scopeBookByAuthor($query, $author)
    {
        return $query->where('author', $author);
    }

    public function averageRating()
    {
        return $this->ratings->avg('rating');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


}
