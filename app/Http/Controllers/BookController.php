<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return view('admin.book.create', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a new book.
     */
    public function create(Request $request)
    {

        $book = Book::createBook($request);

        return redirect()->route('dashboard')->with('success', 'Book added successfully!');
    }

    /**
     * Delete a book.
     */
    public function destroy($id)
    {
        Book::destroy($id);

        return redirect()->back()->with('success', 'Book deleted successfully!');
    }
}
