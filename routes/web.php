<?php
// Modified by Antigravity

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;

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

// Activity detail page
Route::get('/activity/{slug}', [ActivityController::class, 'showPage'])->name('activity.show');

// Category page
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');

// Blog page
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');

// About page
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Contact page
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Cart page
Route::get('/cart', [ActivityController::class, 'cart'])->name('cart.index');

// API routes for AJAX
Route::prefix('api')->group(function () {
    Route::get('/activities', [ActivityController::class, 'getActivities'])->name('api.activities');
    Route::get('/activities/{id}', [ActivityController::class, 'show'])->name('api.activities.show');
    Route::post('/activities/bulk', [ActivityController::class, 'getBulk'])->name('api.activities.bulk');
    Route::post('/commandes', [CommandeController::class, 'store'])->name('api.commandes.store');
    
    // Cart API
    Route::post('/cart/add', [ActivityController::class, 'addToCart'])->name('api.cart.add');
    Route::post('/cart/remove', [ActivityController::class, 'removeFromCart'])->name('api.cart.remove');
    Route::post('/cart/update-quantity', [ActivityController::class, 'updateCartQuantity'])->name('api.cart.update-quantity');
    Route::get('/cart/count', [ActivityController::class, 'getCartCount'])->name('api.cart.count');
    Route::post('/cart/clear', [ActivityController::class, 'clearCart'])->name('api.cart.clear');
});

// SEO routes
Route::get('/sitemap.xml', [ActivityController::class, 'sitemap'])->name('sitemap');
