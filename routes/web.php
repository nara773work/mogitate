<?php

use App\Http\Controllers\ProductController;
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

use Illuminate\Support\Facades\Route;

Route::get('products', [ProductController::class, 'index']);
Route::get('/products/detail/{productId}', [ProductController::class, 'show']);
Route::put('/products/{productId}/update', [ProductController::class, 'update']);
Route::get('/products/register', [ProductController::class, 'register']);
Route::post('/products/store', [ProductController::class, 'store']);
Route::get('/products/search', [ProductController::class, 'search']);
Route::delete('/products/{productId}/delete', [ProductController::class, 'delete']);
