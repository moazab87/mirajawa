<?php

use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\InformationRequestController;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Web\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/change-language/{lang}', function ($lang) {
    $allowedLanguages = ['en', 'ja', 'ar'];
    if (!in_array($lang, $allowedLanguages)) {
        $lang = 'en';
    }
    session(['Lang' => $lang]);
    app()->setLocale($lang);

    return redirect()->back();
})->name('change.language');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about-us', [PageController::class, 'about'])->name('about');
Route::get('/company-profile', [PageController::class, 'companyProfile'])->name('company-profile');
Route::get('/business', [PageController::class, 'business'])->name('business');
Route::get('/why-us', [PageController::class, 'whyUs'])->name('why-us');
Route::get('/history', [PageController::class, 'history'])->name('history');
Route::get('/branches', [PageController::class, 'branches'])->name('branches');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/request-information', [InformationRequestController::class, 'create'])->name('request-information.create');
Route::post('/request-information', [InformationRequestController::class, 'store'])->name('request-information.store');

Route::redirect('/categories', '/products');
Route::get('/categories/{id}', fn ($id) => redirect()->route('web.products.index', ['category' => $id]));
