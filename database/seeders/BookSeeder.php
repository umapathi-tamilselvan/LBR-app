<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = Category::all();

        // Ensure there are categories in the database before seeding books
        if ($categories->isEmpty()) {
            $this->command->info('No categories found! Please seed categories first.');

            return;
        }

        // You can seed 10 books for example, adjust as needed
        Book::factory()->create()->each(function ($book) use ($categories) {
            // Assign a random category to each book
            $book->category_id = $categories->random()->id;
            $book->save();
        });

        $this->command->info('Books seeded successfully!');
    }
}
