<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BorrowerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

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

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/search', [DashboardController::class, 'search'])->name('search');
Route::get('/books', [DashboardController::class, 'book'])->name('books');
Route::get('/borrowers', [DashboardController::class, 'borrower'])->name('borrowers');

Route::get('/book/add', [BookController::class, 'index'])->name('book');
Route::post('/book', [BookController::class, 'create'])->name('book');
Route::delete('/book/delete/{id}', [BookController::class, 'destroy'])->name('book.delete');

Route::get('/borrower/add', [BorrowerController::class, 'index'])->name('borrower');
Route::post('/borrower', [BorrowerController::class, 'create'])->name('borrower');
Route::delete('/borrower/delete/{id}', [BorrowerController::class, 'destroy'])->name('borrower');

Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::get('category/add', [CategoryController::class, 'create'])->name('category');
Route::post('/category', [CategoryController::class, 'store'])->name('category');


require __DIR__.'/auth.php';
