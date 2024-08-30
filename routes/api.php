<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SocialMediaController;
use App\Http\Controllers\Api\TestimonialController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\BlogController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/social-media', [SocialMediaController::class, 'index'])->name('social-media.index');

Route::get('/testimonials',[TestimonialController::class, 'index'])->name('testimonials.index');
Route::get('/services',[ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}',[ServiceController::class, 'show'])->name('services.show');
Route::get('/projects',[ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{slug}',[ProjectController::class, 'show'])->name('projects.show');
Route::get('/blogs',[BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{slug}',[BlogController::class, 'show'])->name('blog.show');
