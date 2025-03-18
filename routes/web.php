<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



use App\Http\Controllers\DashboardController;
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware(['auth']);








use App\Http\Controllers\ProductController;
Route::get('/gestion/produit', [ProductController::class, 'index'])->name('gestion.produit.index');
Route::get('/gestion/produit/create', [ProductController::class, 'create'])->name('gestion.produit.create');
Route::post('/gestion/produit', [ProductController::class, 'store'])->name('gestion.produit.store');
Route::get('/gestion/produit/{id}/edit', [ProductController::class, 'edit'])->name('gestion.produit.edit');
Route::put('/gestion/produit/{id}', [ProductController::class, 'update'])->name('gestion.produit.update');
Route::delete('/gestion/produit/{id}', [ProductController::class, 'destroy'])->name('gestion.produit.destroy');



use App\Http\Controllers\IngredientController;
Route::resource('ingredients', IngredientController::class);



use App\Http\Controllers\PromoCodeController;
Route::get('/promo-codes', [PromoCodeController::class, 'index'])->name('promo_codes.index');
Route::post('/promo-codes', [PromoCodeController::class, 'store'])->name('promo_codes.store');




use App\Http\Controllers\CategoryController;
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

require __DIR__.'/auth.php';
