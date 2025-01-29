<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return view('book.create', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a new book.
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'total_copies' => 'required|integer|min:0',
            'available_copies' => 'required|integer|min:0|max:'.$request->input('total_copies'),
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $validated['image'] = $request->hasFile('image')
            ? $request->file('image')->store('books', 'public')
            : null;

        Book::create($validated);

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
