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
    session(['Lang' => $lang]);
    app()->setLocale($lang);

    return redirect()->back();
})->name('change.language');


Route::get('/',             function () {
    return redirect()->route('admin.admin.index');
});
