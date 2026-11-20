<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\MemberController;

// Route::get('products', function () {
//     return view('products.index');
// });

Route::resource('products', ProductController::class);
Route::get('api/products', [ProductController::class, 'apiData'])->name('products.api');

Route::get('/products/{id}/edit', [ProductController::class, 'edit'])
    ->name('products.edit');

Route::put('/products/{id}', [ProductController::class, 'update'])
    ->name('products.update');

Route::delete('/products/{id}', [ProductController::class, 'destroy'])
    ->name('products.destroy');


Route::get('/members/api', [MemberController::class, 'api'])
    ->name('members.api');

Route::resource('members', MemberController::class);