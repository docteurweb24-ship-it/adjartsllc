<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\PromotionController as AdminPromotionController;
use App\Http\Controllers\Admin\BlogPostController as AdminBlogPostController;
use App\Http\Controllers\Admin\AppearanceController;
use App\Http\Controllers\Admin\SiteSettingsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Routes d'authentification (DOIT ÊTRE AVANT LES AUTRES)
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Routes Publiques
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/collections', [ProductController::class, 'index'])->name('collections');
Route::get('/produit/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'sendMessage']);

// Route about
Route::get('/a-propos', function () {
    return view('about');
})->name('about');

// Route promotions publique
Route::get('/promotions', function () {
    $promotions = \App\Models\Promotion::where('is_active', true)
                                      ->orderBy('created_at', 'desc')
                                      ->get();
    return view('promotions', compact('promotions'));
})->name('promotions');

// Route pour les pages dynamiques (sauf about)
Route::get('/{slug}', [PageController::class, 'show'])->where('slug', '^(?!a-propos|admin|collections|blog|contact|promotions).*$');

// Route pour le changement de langue
Route::get('/language/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'fr'])) {
        abort(400);
    }
    session()->put('locale', $locale);
    return redirect()->back();
})->name('language');

// Routes Admin (TOUTES PROTÉGÉES)
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Produits
    Route::resource('/products', AdminProductController::class);
    
    // Catégories  
    Route::resource('/categories', AdminCategoryController::class);
    
    // Pages
    Route::resource('/pages', AdminPageController::class);
    
    // Promotions
    Route::resource('/promotions', AdminPromotionController::class);
    
    // Blog
    Route::resource('/blog-posts', AdminBlogPostController::class);
    
    // Header
    Route::get('/header', [AppearanceController::class, 'editHeader'])->name('header.edit');
    Route::put('/header', [AppearanceController::class, 'updateHeader'])->name('header.update');
    
    // Footer
    Route::get('/footer', [AppearanceController::class, 'editFooter'])->name('footer.edit');
    Route::put('/footer', [AppearanceController::class, 'updateFooter'])->name('footer.update');
    
    // Réglages du Site
    Route::get('/site-settings', [SiteSettingsController::class, 'edit'])->name('site-settings.edit');
    Route::put('/site-settings', [SiteSettingsController::class, 'update'])->name('site-settings.update');
    
    // Gestion des médias
    Route::post('/upload-media', [AppearanceController::class, 'uploadMedia'])->name('upload.media');
    Route::delete('/delete-media/{id}', [AppearanceController::class, 'deleteMedia'])->name('delete.media');
    
    // Gestion des utilisateurs (AJOUTÉ ICI)
    Route::resource('users', UserController::class)->except(['show']);
    Route::put('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::put('users/{user}/change-password', [UserController::class, 'changePassword'])->name('users.change-password');
});