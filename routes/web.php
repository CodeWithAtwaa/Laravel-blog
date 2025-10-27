<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\ThemeController;
use App\Models\subscriber;
use Illuminate\Support\Facades\Route;


// Theme Routes
Route::controller(ThemeController::class)->name('theme.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/category{id}', 'category')->name('category');
    Route::get('/contact', 'contact')->name('contact');
    // Route::get('/single-blog', 'singleBlog')->name('singleBlog');
});


// Subscriber Routes
Route::post('subscriber/store', [SubscriberController::class, 'store'])->name('subscriber.store');

// Contact Routes
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');

// Comments Routes
Route::post('/comments/store', [CommentController::class, 'store'])->name('comments.store');


// Blog Routes
Route::resource('blogs' , BlogController::class);
Route::get('/my-blogs' , [BlogController::class , 'myBlogs'])->name('blogs.my-blogs');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
