<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminuserController;
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use Spatie\Permission\Models\Role;

Route::middleware(['admin_guest'])->prefix('/admin/')->name('admin.')->group(function(){

Route::get('login',[LoginController::class,'showLoginPage'])->name('login.page');
Route::post('login',[LoginController::class,'login'])->name('login');

});


Route::middleware(['admin_auth:admin,superadmin'])->prefix('/admin/')->name('admin.')->group(function(){

    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('logout',[DashboardController::class,'logout'])->name('logout');

    Route::get('users', [UserController::class, 'index'])->name('frontedUsers.list');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('frontedUsers.edit');
    Route::put('users/{id}', [UserController::class, 'update'])->name('frontedUsers.update');
    Route::get('users/create', [UserController::class, 'create'])->name('frontedUsers.create');
    Route::post('users', [UserController::class, 'store'])->name('frontedUsers.store');
    Route::post('users/{id}/status', [UserController::class, 'changeStatus'])->name('frontedUsers.changeStatus');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('frontedUsers.destroy');
    Route::post('users/{id}/restore', [UserController::class, 'restore'])->name('frontedUsers.restore');


    Route::get('adminusers', [AdminuserController::class, 'index'])->name('adminUsers.list');
    Route::get('adminusers/{id}/edit', [AdminuserController::class, 'edit'])->name('adminUsers.edit');
    Route::put('adminusers/{id}', [AdminuserController::class, 'update'])->name('adminUsers.update');
    Route::get('adminusers/create', [AdminuserController::class, 'create'])->name('adminUsers.create');
    Route::post('adminusers', [AdminuserController::class, 'store'])->name('adminUsers.store');
    Route::post('adminusers/{id}/status', [AdminuserController::class, 'changeStatus'])->name('users.changeStatus');
    Route::delete('adminusers/{id}', [AdminuserController::class, 'destroy'])->name('users.destroy');
    Route::post('adminusers/{id}/restore', [AdminuserController::class, 'restore'])->name('users.restore');


    Route::get('events', [AdminEventController::class, 'index'])->name('events.index');
    Route::get('events/{event}/edit', [AdminEventController::class, 'edit'])->name('events.edit');
    Route::put('events/{event}', [AdminEventController::class, 'update'])->name('events.update');
    Route::get('events/create', [AdminEventController::class, 'create'])->name('events.create');
    Route::post('events', [AdminEventController::class, 'store'])->name('events.store');    
    Route::post('events/{event}/status', [AdminEventController::class, 'changeStatus'])->name('events.changeStatus');
    Route::delete('events/{event}', [AdminEventController::class, 'destroy'])->name('events.destroy');
    Route::post('events/{event}/restore', [AdminEventController::class, 'restore'])->name('events.restore');

    Route::get('visitors', [VisitorController::class, 'visitors'])->name('visitors.list');

    Route::resource('blogs', BlogController::class);
    Route::post('blogs/{blog}/status', [BlogController::class, 'changeStatus'])->name('blogs.changeStatus');
    Route::get('blogs/trashed', [BlogController::class, 'trashed'])->name('blogs.trashed');
    Route::post('blogs/restore/{id}', [BlogController::class, 'restore'])->name('blogs.restore');

    Route::resource('categories', CategoryController::class);
    Route::post('categories/{category}/status', [CategoryController::class, 'changeStatus'])->name('categories.changeStatus');
    Route::get('categories/trashed', [CategoryController::class, 'trashed'])->name('categories.trashed');
    Route::post('categories/restore/{id}', [CategoryController::class, 'restore'])->name('categories.restore');

});

