<?php

use Illuminate\Support\Facades\Route;

Route::get('/post/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('post');

Route::middleware(['auth'])->group(function() {

    Route::get('/admin/posts/', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');
    Route::get('/admin/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
    Route::post('/admin/posts/', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
    
    Route::delete('/admin/posts/{post}/destroy', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.destroy');
    Route::patch('/admin/posts/{post}/update', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');
    Route::get('/admin/posts/{post}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
    
});

