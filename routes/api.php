<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::post('/contact-me', [ContactController::class, 'index']);
Route::post('/subscribe', [ContactController::class, 'subscribe']);


// project routes
Route::get('/categories', [ProjectController::class, 'categories']);
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/project-details/{slug}', [ProjectController::class, 'projectDetails']);
Route::get('/project-by-category/{categoryId}', [ProjectController::class, 'projectByCategory']);
Route::get('/project-by-tag/{tag}', [ProjectController::class, 'projectByTag']);
Route::get('/project-by-client/{client}', [ProjectController::class, 'projectByClient']);
Route::get('/project-by-location/{location}', [ProjectController::class, 'projectByLocation']);
Route::get('/testimonials', [ProjectController::class, 'testimonials']);
Route::get('/testimonials/{projectId}', [ProjectController::class, 'testimonialByProject']);


// service routes
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/packages', [ServiceController::class, 'pricingPlans']);
Route::get('/clients', [ServiceController::class, 'clients']);
Route::get('/faqs', [ServiceController::class, 'faqs']);

// resume routes
Route::get('/experiences', [ResumeController::class, 'experiences']);
Route::get('/education', [ResumeController::class, 'education']);
Route::get('/trainings', [ResumeController::class, 'trainings']);
Route::get('/certificates', [ResumeController::class, 'certificates']);
Route::get('/case-studies', [ResumeController::class, 'caseStudies']);


// about routes

Route::get('/hero', [AboutController::class, 'hero']);
Route::get('/skills', [AboutController::class, 'skills']);
Route::get('/counters', [AboutController::class, 'counters']);
// Route::get('/achievements', [AboutController::class, 'achievements']);
// Route::get('/languages', [AboutController::class, 'languages']);
// Route::get('/hobbies', [AboutController::class, 'hobbies']);

//setting routes
Route::get('/settings', [SettingController::class, 'index']);
Route::get('/socials', [SettingController::class, 'socials']);
Route::get('/modules', [SettingController::class, 'modules']);
Route::get('/module-texts', [SettingController::class, 'moduleTexts']);

// blog routes
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/{slug}', [BlogController::class, 'show']);
Route::get('/blog/latest', [BlogController::class, 'latestPosts']);
Route::get('/blog/popular', [BlogController::class, 'popularPosts']);
Route::get('/blog/featured', [BlogController::class, 'featuredPosts']);
Route::get('/blog/related/{slug}', [BlogController::class, 'relatedPosts']);
Route::get('/blog/comments/{postId}', [BlogController::class, 'postComments']);
Route::get('/blog/categories', [BlogController::class, 'categories']);
Route::get('/blog/tags', [BlogController::class, 'tags']);
Route::get('/blog/archives', [BlogController::class, 'archives']);
Route::get('/blog/search', [BlogController::class, 'search']);
Route::get('/category/{slug}/posts', [BlogController::class, 'categoryPosts']);
Route::get('/tag/{slug}/posts', [BlogController::class, 'tagPosts']);
// dashboard routes
