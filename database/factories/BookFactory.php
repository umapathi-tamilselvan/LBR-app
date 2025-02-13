<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        Storage::disk('public')->makeDirectory('books');

        $imageUrl = 'https://picsum.photos/640/480';
        $imageName = Str::random(10).'.jpg';
        $imagePath = 'books/'.$imageName;

        $imageContent = Http::get($imageUrl)->body();
        Storage::disk('public')->put($imagePath, $imageContent);

        // List of Indian book names and authors
        $books = [
            ['title' => 'The God of Small Things', 'author' => 'Arundhati Roy'],
            ['title' => 'India After Gandhi', 'author' => 'Ramachandra Guha'],
            ['title' => 'The White Tiger', 'author' => 'Aravind Adiga'],
            ['title' => 'Midnight’s Children', 'author' => 'Salman Rushdie'],
            ['title' => 'The Namesake', 'author' => 'Jhumpa Lahiri'],
            ['title' => 'Chetan Bhagat', 'author' => 'Five Point Someone'],
            ['title' => 'A Fine Balance', 'author' => 'Rohinton Mistry'],
            ['title' => 'Shantaram', 'author' => 'Gregory David Roberts'],
            ['title' => 'The Inheritance of Loss', 'author' => 'Kiran Desai'],
            ['title' => 'The Great Indian Novel', 'author' => 'Shashi Tharoor'],
        ];

        // Randomly select a book from the list
        $book = $books[array_rand($books)];

        return [
            'name' => $book['title'],
            'author' => $book['author'],
            'image' => $imagePath,
            'total_copies' => 10,
            'available_copies' => 10,
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id, // Assign random category
        ];
    }
}
