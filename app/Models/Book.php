<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function scopeNotBorrowedBook(Builder $query)
    {

        $query->whereDoesntHave('borrowRecords', function ($query) {
            $query->whereNull('due_date');
        });
    }

    public function scopeBookByCategory(Builder $query, $category)
    {
        $query->whereHas('category', function ($query) use ($category) {
            $query->where('name', $category);
        });
    }

    public function scopeBookByAuthor(Builder $query, $author)
    {
        $query->where('author', $author);
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
