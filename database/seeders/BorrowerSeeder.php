<?php

namespace Database\Seeders;

use App\Models\Borrower;
use Illuminate\Database\Seeder;

class BorrowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Borrower::factory(20)->create();
    }
}
