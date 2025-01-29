<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::with('books')->get();

        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
        ]);

        $category = new Category;
        $category->name = request()->name;
        $category->save($data);

        return redirect('/home');
    }
}
