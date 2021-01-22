<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use BaconQrCode\Renderer\Path\Path;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::group(['middlewire' => 'auth'], function () {
    #Categoires
    Route::get('/get-categoy', [CategoryController::class, 'index'])->name('get-categories');
    Route::post('/savecategory', [CategoryController::class, 'store']);
    Route::delete('/remove-category/{id}', [CategoryController::class, 'destroy']);
    Route::post('/delete-categories', [CategoryController::class, 'deleteCategories']);
    Route::post('/active-categories', [CategoryController::class, 'activeCategories']);
    Route::post('/active-category', [CategoryController::class, 'activeCategory']);
    Route::post('/deactive-category/{id}', [CategoryController::class, 'deactiveCategory']);
    Route::post('/deactive-categories', [CategoryController::class, 'deactiveCategories']);
    Route::get('/fatch-category/{slug}', [CategoryController::class, 'edit'])->name('fatch-category');
    Route::post('/update-category/{slug}', [CategoryController::class, 'update'])->name('update-category');
    #Tags
    Route::post('/store-tag', [TagController::class, 'store']);
    Route::get('/index-tag', [TagController::class, 'index']);
    Route::delete('/delete-tag/{slug}', [TagController::class, 'destroy']);
    Route::get('fetch-tag/{slug}', [TagController::class, 'edit']);
    Route::post('update-tag/{slug}', [TagController::class, 'update']);
    Route::post('/active-tag/{id}', [TagController::class, 'activeTag']);
    Route::post('/deactive-tag/{id}', [TagController::class, 'deactiveTag']);
    Route::post('/delete-tags', [TagController::class, 'deleteTags']);
    Route::post("/active-tags", [TagController::class, 'ActiveTags']);
    Route::post("/deactive-tags", [TagController::class, 'DeactiveTags']);
    #Posts
    Route::get('/get-posts', [PostController::class, 'index'])->name('post');
    Route::delete("/remove-post/{slug}", [PostController::class, 'destroy']);
    Route::post('/store-post', [PostController::class, 'store']);
    Route::post('/delete-posts', [PostController::class, 'DeletePosts']);
});
Route::get('/{anypath}', [DashboardController::class, 'index'])->where('path', '.*');
