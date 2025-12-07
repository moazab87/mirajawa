<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FixedPageController;
use App\Http\Controllers\Admin\SettingsController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'guest'], function () {
    Route::get('/login',                        [AuthController::class, 'showLoginForm'])->name('show.login');
    Route::post('/login',                       [AuthController::class, 'login'])->name('login');
});


Route::group(['middleware' => ['auth:admin']], function () {
    Route::post('/logout',                          [AuthController::class, 'logout'])->name('logout');

    Route::get('/',                                 [DashboardController::class, 'index'])->name('admin.index');

    // Route::get('/read-all-notifications',           [DashboardController::class, 'readAllNotifications'])->name('notifications.readAll');
    // Route::get('/notification/{id}/details',        [DashboardController::class, 'notificationDetails'])->name('notifications.details');

    Route::get('/profile',                   [DashboardController::class, 'edit'])->name('profile.edit');
    Route::post('/profile',                  [DashboardController::class, 'update'])->name('profile.update');
    Route::get('/password',                  [DashboardController::class, 'EditPassword'])->name('password.edit');
    Route::post('/password',                 [DashboardController::class, 'UpdatePassword'])->name('password.update');

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/',                          [SettingsController::class, 'index'])->name('settings.index');
        Route::post('/',                         [SettingsController::class, 'update'])->name('settings.update');
    });

    // Notifications
    // Route::resource('notifications',            NotificationController::class);

    // // admins
    // Route::resource('admins',                   AdminController::class);
    // Route::resource('roles',                    RoleController::class);
    // // users
    // Route::resource('users',                    UsersController::class);
    // Route::get('users/{user}/block/{action}',   [UsersController::class, 'block'])->name('users.block');

    // Route::resource('clients',                  ClientController::class);
    Route::resource('categories',                    CategoryController::class);
    Route::resource('fixedPages',                    FixedPageController::class);
    // Route::resource('projects',                 ProjectController::class);
    // Route::resource('tasks',                    TaskController::class);
    // Route::get('/clients/{client}/projects',    [ProjectController::class, 'getProjectsByClient'])->name('clients.projects');

});
