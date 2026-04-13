<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Models\Post;

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::resource('categories', CategoryController::class);

Route::patch('posts/{post}/publish', [PostController::class, 'publish'])->name('posts.publish');

Route::resource('posts', PostController::class);

Route::get('posts/{post}/download', function (Post $post) {
    return Storage::disk('public')->download($post->image_path);
})->name('posts.download');
