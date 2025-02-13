<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'author', 'category_id', 'total_copies', 'available_copies', 'image'];

    public function borrower()
    {
        return $this->hasMany(Borrower::class);
    }

    public function borrowbook()
    {
        return $this->hasMany(Borrowbook::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public static function createBook(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:books,name|string|max:255',
            'author' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'total_copies' => 'required|integer|min:1',
            'available_copies' => 'required|integer|min:0|max:'.$request->input('total_copies'),
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('books', 'public');
        }

        return self::create($validated);
    }
}
