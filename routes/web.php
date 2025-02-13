<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowBookController;
use App\Http\Controllers\BorrowerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/search', [DashboardController::class, 'search'])->name('search');
    Route::get('/books', [DashboardController::class, 'book'])->name('books');
    Route::get('/borrowers', [DashboardController::class, 'borrower'])->name('borrowers');

    Route::get('/books/add', [BookController::class, 'index'])->name('books');
    Route::post('/books', [BookController::class, 'create'])->name('books');
    Route::delete('/book/delete/{id}', [BookController::class, 'destroy'])->name('book.delete');

    Route::get('/borrower/add', [BorrowerController::class, 'index'])->name('borrower');
    Route::post('/borrower', [BorrowerController::class, 'create'])->name('borrower');
    Route::delete('/borrower/delete/{id}', [BorrowerController::class, 'destroy'])->name('borrower');

    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('category/add', [CategoryController::class, 'create'])->name('category');
    Route::post('/category', [CategoryController::class, 'store'])->name('category');
    Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
});

Route::get('/home', [UserController::class, 'dashIndex']);
Route::get('/book', [BorrowBookController::class, 'index']);
require __DIR__.'/auth.php';
