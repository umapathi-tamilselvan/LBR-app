<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

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

        return [
            'name' => $this->faker->sentence(3),
            'author' => $this->faker->name,
            'image' => $imagePath,
            'total_copies' => '10',
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id, // Assign random category
        ];
    }
}
