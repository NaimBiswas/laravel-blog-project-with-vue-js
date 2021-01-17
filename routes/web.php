<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
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

    Route::get('/post', [PostController::class, 'index'])->name('post');
    Route::post('/savecategory', [CategoryController::class, 'store'])->name('savecategory');
    Route::get('/get-categoy', [CategoryController::class, 'index'])->name('get-categories');
    Route::delete('/remove-category/{id}', [CategoryController::class, 'destroy']);
    Route::get('/editecategory/{id}', [CategoryController::class, 'update']);
    Route::get('/fatch-category/{slug}', [CategoryController::class, 'edit'])->name('fatch-category');
});
Route::get('/{anypath}', [DashboardController::class, 'index'])->where('path', '.*');
