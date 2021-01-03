<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/post/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('post');

// reaching pages only through authentication
Route::middleware('auth')->group(function(){

    Route::get('/admin', [App\Http\Controllers\AdminsController::class, 'index'])->name('admin.index');

    Route::get('/admin/posts/', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');
    Route::get('/admin/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
    Route::post('/admin/posts/', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');

    Route::delete('/admin/posts/{post}/destroy', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.destroy');
    Route::patch('/admin/posts/{post}/update', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');
    Route::get('/admin/posts/{post}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');

    Route::put('admin/users/{user}/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.profile.update');

    Route::delete('admin/users/{user}/destroy',[App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');

});

// only users with admin role can see the all users table
Route::middleware(['role:Admin', 'auth'])->group(function() {
    Route::get('admin/users',[App\Http\Controllers\UserController::class, 'index'])->name('users.index');
});


// ADMIN AND MODEL OWNER -> SAME ACCESS TO PROFILE OWNER / using the UserPolicy
Route::middleware(['can:view,user'])->group(function() {
    Route::get('admin/users/{user}/profile', [App\Http\Controllers\UserController::class, 'show'])->name('user.profile.show');
});

//ALTERNATIV WITH can:
// Route::get('/admin/posts/{post}/edit', [App\Http\Controllers\PostController::class, 'edit'])->middleware('can:view, post')->name('post.edit');
