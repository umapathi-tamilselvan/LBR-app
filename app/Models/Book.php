<?php

namespace App\Models;

use App\Models\Borrower;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'author', 'category_id', 'total_copies', 'available_copies', 'image'];



    public function borrower()
    {
        return $this->hasMany(Borrower::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
