<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowbook;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashIndex()
    {
        $bookCount = Book::where('total_copies', '>', 0)->sum('total_copies');
        $borrowedBookCount = Borrowbook::count();

        return view('user.dashboard', compact('bookCount', 'borrowedBookCount'));

    }
}
