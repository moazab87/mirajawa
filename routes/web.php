<?php

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

Route::get('/change-language/{lang}', function ($lang) {
    $allowedLanguages = ['en', 'ja', 'ar'];
    // Validate language is in allowed list, otherwise default to 'en'
    if (!in_array($lang, $allowedLanguages)) {
        $lang = 'en';
    }
    session(['Lang' => $lang]);
    app()->setLocale($lang);

    return redirect()->back();
})->name('change.language');

// Public Website Routes
Route::get('/', [App\Http\Controllers\Web\HomeController::class, 'index'])->name('home');
Route::get('/categories', [App\Http\Controllers\Web\CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [App\Http\Controllers\Web\CategoryController::class, 'show'])->name('categories.show');
Route::get('/products/{id}', [App\Http\Controllers\Web\ProductController::class, 'show'])->name('products.show');
