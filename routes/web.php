<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// About page
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Contact page
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'storeContact'])->name('contact.store');

// Property search route
Route::post('/search', [PropertyController::class, 'search'])->name('properties.search');
Route::get('/search', [PropertyController::class, 'searchResults'])->name('properties.search.results');

Route::group(['prefix' => 'properties'], function () {
    // Properties listing
    Route::get('/', [PropertyController::class, 'index'])->name('properties.index');

    // Property details
    Route::get('/{property}', [PropertyController::class, 'show'])->name('property.show');

    // Create property
    Route::get('/create', [PropertyController::class, 'create'])->name('properties.create');
    Route::post('/', [PropertyController::class, 'store'])->name('properties.store');

    // Edit property
    Route::get('/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
    Route::put('/{property}', [PropertyController::class, 'update'])->name('properties.update');
    Route::post('/property/{id}/contact', [PropertyController::class, 'contact'])->name('property.contact');


});

Route::get('/admin/login', [HomeController::class, 'login'])->name('login');
Route::post('/admin/login', [HomeController::class, 'authenticate'])->name('admin.login');

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/properties/create', [AdminController::class, 'createProperty'])->name('properties.create');
    Route::post('/properties', [AdminController::class, 'storeProperty'])->name('properties.store');
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/properties', [AdminController::class, 'listProperties'])->name('admin.properties.index');
    Route::get('/properties/{property}/edit', [AdminController::class, 'editProperty'])->name('properties.edit');
    Route::post('/properties/{property}/edit', [AdminController::class, 'updateProperty'])->name('properties.update');
    Route::delete('/properties/{property}', [AdminController::class, 'destroyProperty'])->name('properties.destroy');
});
