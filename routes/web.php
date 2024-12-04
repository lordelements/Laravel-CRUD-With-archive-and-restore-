<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'user'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard')->middleware(['auth', 'verified', 'admin']);
// Route::get('admin/profile', [HomeController::class, 'edit'])->name('admin.profile.edit')->middleware(['auth', 'verified', 'admin']);


// Route::get('admin/profile/edit', [AdminController::class, 'edit'])->name('admin.profile.edit')->middleware(['auth', 'verified', 'admin']);
// Route::patch('admin/profile/update', [AdminController::class, 'update'])->name('admin.profile.update');
// Route::delete('admin/profile', [AdminController::class, 'destroy'])->name('admin.profile.delete');

Route::middleware('auth')->group(function () {
    Route::get('admin/profile/edit', [AdminController::class, 'edit'])->name('admin.profile.edit')->middleware(['auth', 'verified', 'admin']);
    Route::patch('admin/profile/update', [AdminController::class, 'update'])->name('admin.profile.update');
    Route::delete('admin/profile', [AdminController::class, 'destroy'])->name('admin.profile.delete');
});


// CREATE POSTS
Route::get('admin/create_posts', [PostsController::class, 'create_posts'])->name('admin.create_posts');
Route::get('posts/index', [PostsController::class, 'index'])->name('posts.index');
Route::post('store-posts', [PostsController::class, 'store'])->name('store-posts');
Route::get('posts/view-posts/{id}', [PostsController::class, 'viewPosts']);
Route::delete('posts/view-posts/{id}', [PostsController::class, 'deletePosts']);

Route::get('edit-posts/{id}', [PostsController::class, 'editPostsForm']);
Route::put('update-posts/{id}', [PostsController::class, 'updatePosts'])->name('update-posts');

Route::get('registered_users', [RegisteredUserController::class, 'usersCounts'])->name('registered_users');

Route::get('posts/trash', [PostsController::class, 'trash'])->name('posts.trash'); //routes to add the deleted posts to archive
Route::get('restore/{id}', [PostsController::class, 'restore'])->name('posts.restore'); //routes to restore the deleted posts added on archive
Route::get('/posts/{id}/deletePost_permanent', [PostsController::class, 'deletePost_permanent'])->name('posts.deletePost_permanent'); // deletes posts permanently