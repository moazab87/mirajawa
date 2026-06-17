<?php

use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactInformationController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FixedPageController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\InformationBlockController;
use App\Http\Controllers\Admin\InformationRequestController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductGroupController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SocialController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'guest'], function () {
    Route::get('/login',                        [AuthController::class, 'showLoginForm'])->name('show.login');
    Route::post('/login',                       [AuthController::class, 'login'])->name('login');
});


Route::group(['middleware' => ['auth:admin']], function () {
    Route::post('/logout',                          [AuthController::class, 'logout'])->name('logout');

    Route::get('/',                                 [DashboardController::class, 'index'])->name('admin.index');

    Route::get('/profile',                   [DashboardController::class, 'edit'])->name('profile.edit');
    Route::post('/profile',                  [DashboardController::class, 'update'])->name('profile.update');
    Route::get('/password',                  [DashboardController::class, 'EditPassword'])->name('password.edit');
    Route::post('/password',                 [DashboardController::class, 'UpdatePassword'])->name('password.update');

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/',                          [SettingsController::class, 'index'])->name('settings.index');
        Route::post('/',                         [SettingsController::class, 'update'])->name('settings.update');
    });

    Route::resource('categories',                    CategoryController::class);
    Route::resource('productGroups',                 ProductGroupController::class);
    Route::resource('products',                      ProductController::class);
    Route::resource('fixedPages', FixedPageController::class)->only(['index', 'show', 'edit', 'update']);
    Route::resource('sliders',                       SliderController::class);
    Route::resource('socials',                       SocialController::class);
    Route::resource('addresses',                     AddressController::class);
    Route::resource('branches',                      BranchController::class);
    Route::resource('faqs',                          FaqController::class);
    Route::resource('profiles',                      ProfileController::class);
    Route::resource('histories',                     HistoryController::class);
    Route::resource('informationBlocks',             InformationBlockController::class);
    Route::resource('contactInformation',            ContactInformationController::class);

    Route::resource('contactMessages', ContactMessageController::class)->except(['create', 'store', 'edit', 'update']);
    Route::post('contactMessages/{contactMessage}/mark-replied', [ContactMessageController::class, 'markReplied'])->name('contactMessages.markReplied');

    Route::resource('informationRequests', InformationRequestController::class)->except(['create', 'store', 'edit', 'update']);
    Route::post('informationRequests/{informationRequest}/mark-replied', [InformationRequestController::class, 'markReplied'])->name('informationRequests.markReplied');

    Route::delete('products/{product}/attachments/{attachment}', [ProductController::class, 'deleteAttachment'])->name('products.attachments.destroy');
    Route::delete('branches/{branch}/images/{image}', [BranchController::class, 'destroyImage'])->name('branches.images.destroy');
});
