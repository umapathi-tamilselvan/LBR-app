<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('borrowbooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id');
            $table->foreignId('user_id');
            $table->string('date_of_borrow');
            $table->string('date_of_return');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowbooks');
    }
};
