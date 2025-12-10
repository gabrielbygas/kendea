<?php
// Modified by Claude

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CommandeController;

// Main page (SPA entry point)
Route::get('/', [ActivityController::class, 'index'])->name('home');

// API routes for AJAX
Route::prefix('api')->group(function () {
    // Activities
    Route::get('/activities', [ActivityController::class, 'getActivities'])->name('api.activities');
    Route::get('/activities/{id}', [ActivityController::class, 'show'])->name('api.activities.show');

    // Orders
    Route::post('/commandes', [CommandeController::class, 'store'])->name('api.commandes.store');
});

// SEO routes
Route::get('/sitemap.xml', [ActivityController::class, 'sitemap'])->name('sitemap');
