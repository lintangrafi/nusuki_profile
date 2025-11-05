<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\ProjectController as PublicProjectController;
use App\Http\Controllers\ServiceController as PublicServiceController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

// Homepage should use the home method from PageController
Route::get('/', [PageController::class, 'home'])->name('home');

// Public static pages
Route::get('/tentang-kami', [PageController::class, 'about'])->name('about');
Route::get('/kontak-kami', [PageController::class, 'contact'])->name('contact');

// Public project routes
Route::get('/proyek', [PublicProjectController::class, 'index'])->name('projects.index');
Route::get('/proyek/{project:slug}', [PublicProjectController::class, 'show'])->name('projects.show');

// Public service route
Route::get('/layanan', [PublicServiceController::class, 'index'])->name('services.index');

// Sitemap route
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Robots.txt route
Route::get('/robots.txt', [RobotsController::class, 'index'])->name('robots');

// User dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Admin routes (including dashboard)
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        Route::resource('projects', ProjectController::class);
        Route::resource('services', ServiceController::class);
    });
});

require __DIR__.'/auth.php';
