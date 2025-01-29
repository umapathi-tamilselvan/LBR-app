<?php

namespace Database\Seeders;

use App\Models\Borrower;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BorrowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Borrower::factory(100)->create();
    }
}
