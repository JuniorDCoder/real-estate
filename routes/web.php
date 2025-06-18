<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AgentController;

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


    // Delete property
    Route::delete('/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');
});
