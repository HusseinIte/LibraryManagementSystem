<?php

namespace App\Service;

use App\Models\Book;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookService
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeBook(array $data)
    {
        return Book::create([
            'title' => $data['title'],
            'author' => $data['author'],
            'description' => $data['description'],
            'published_at' => $data['published_at']
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function showBookById($id)
    {
        $book = Book::find($id);
        if (!$book) {
            throw new ModelNotFoundException('The book with the given ID was not found.');
        }
        return $book;

    }

    /**
     * Update the specified resource in storage.
     */
    public function updateBook(array $data, $id)
    {
        $book = Book::find($id);
        if (!$book) {
            throw new ModelNotFoundException('The book with the given ID was not found.');
        }
        $book->update($data);
        return $book;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteBook($id)
    {
        $book = Book::find($id);
        if (!$book) {
            throw new ModelNotFoundException('The book with the given ID was not found.');
        }
        $book->delete();
    }

}
