<?php
// Modified by Antigravity

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CommandeController;

// Language switch
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['fr', 'en'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Activities page
Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');

// API routes for AJAX
Route::prefix('api')->group(function () {
    Route::get('/activities', [ActivityController::class, 'getActivities'])->name('api.activities');
    Route::get('/activities/{id}', [ActivityController::class, 'show'])->name('api.activities.show');
    Route::post('/commandes', [CommandeController::class, 'store'])->name('api.commandes.store');
});

// SEO routes
Route::get('/sitemap.xml', [ActivityController::class, 'sitemap'])->name('sitemap');
