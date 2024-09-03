<?php

namespace App\Service;

use App\Models\Book;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class BookService
 * @package App\Service
 */
class BookService
{

    /**
     * @param $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index($request)
    {
        $query = Book::query();
//        Filter by borrowing availability
        if ($request->has('NotBorrowed')) {
            $query->notBorrowedBook();
        }
//        filter book by Author
        if ($request->filled('author')) {
            $query->BookByAuthor($request->input('author'));
        }
//       Filter By category
        if ($request->filled('category')) {
            $query->bookByCategory($request->input('category'));
        }
        return $query->with('category')->get();
    }


    /**
     * @param array $data
     * @return mixed
     */
    public function storeBook(array $data)
    {
        return Book::create([
            'title' => $data['title'],
            'author' => $data['author'],
            'description' => $data['description'],
            'published_at' => $data['published_at'],
            'category_id' => $data['category_id']
        ]);
    }


    /**
     * @param $id
     * @return mixed
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
     * @param array $data
     * @param $id
     * @return mixed
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
     * @param $id
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
