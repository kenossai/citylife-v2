<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\View\View;

class BooksController extends Controller
{
    public function index(): View
    {
        $books = Book::published()
            ->with('leader')
            ->orderBy('title')
            ->get();

        $categories = $books
            ->pluck('categories')
            ->filter()
            ->flatten()
            ->unique()
            ->sort()
            ->prepend('All')
            ->values();

        return view('pages.books', compact('books', 'categories'));
    }

    public function show(string $slug): View
    {
        $book = Book::where('slug', $slug)
            ->published()
            ->with('leader')
            ->firstOrFail();

        $relatedBooks = Book::published()
            ->where('id', '!=', $book->id)
            ->where(function ($q) use ($book) {
                if ($book->author) {
                    $q->where('author', $book->author);
                }
            })
            ->orderBy('title')
            ->limit(6)
            ->get();

        return view('pages.book-detail', compact('book', 'relatedBooks'));
    }
}
