<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrower;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $bookCount = Book::where('available_copies', '>', 0)->sum('available_copies');
        $availableBookCount = Book::where('available_copies', '>', 0)->count();
        $borrowerCount = Borrower::count();
        $categories = Category::withCount('books')->get();

        return view('dashboard', compact('bookCount', 'borrowerCount', 'categories', 'availableBookCount'));
    }

    public function book(Request $request)
    {
        $search = $request->input('search');

        // Fetch books with optional search
        $books = Book::with('category')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%");
            })
            ->paginate(8);

        return view('book.index', compact('books', 'search'));
    }

    public function borrower(Request $request)
    {
        $search = $request->input('search');

        // Fetch borrowers with optional search
        $borrowers = Borrower::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })
            ->paginate(10);

        return view('borrower.index', compact('borrowers', 'search'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search in multiple models (Books, Borrowers, Categories)
        $books = Book::where('name', 'like', '%'.$query.'%')
            ->orWhere('author', 'like', '%'.$query.'%')  // You can add more fields for searching
            ->get();

        $borrowers = Borrower::where('name', 'like', '%'.$query.'%')->get();
        $categories = Category::where('name', 'like', '%'.$query.'%')->get();

        return view('search.index', compact('books', 'borrowers', 'categories', 'query'));
    }

}
