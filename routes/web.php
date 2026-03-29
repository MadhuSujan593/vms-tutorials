<?php

use App\Http\Controllers\ProfileController;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;
use App\Models\Category;
use App\Models\Tutorial;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\PublicController;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/tutorials/{category:slug}', [PublicController::class, 'category'])->name('public.category');
Route::get('/tutorials/{category:slug}/{tutorial:slug}', [PublicController::class, 'tutorial'])->name('public.tutorial');

Route::get('/sitemap.xml', function () {
    $sitemap = \Spatie\Sitemap\Sitemap::create();
    
    // Add Home
    $sitemap->add(Url::create(route('home'))->setPriority(1.0)->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));
    
    // Add Categories
    Category::all()->each(function (Category $category) use ($sitemap) {
        $sitemap->add(Url::create(route('public.category', $category))
            ->setPriority(0.8)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));
            
        // Add Tutorials inside this category
        $category->tutorials()->where('is_published', true)->get()->each(function (Tutorial $tutorial) use ($sitemap, $category) {
            // Skip top-level parents that redirect to first child (they don't have their own accessible content)
            if ($tutorial->parent_id === null && $tutorial->children()->where('is_published', true)->exists()) {
                return;
            }
            
            $sitemap->add(Url::create(route('public.tutorial', [$category->slug, $tutorial->slug]))
                ->setPriority(0.6)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));
        });
    });

    return $sitemap->toResponse(request());
});

use App\Http\Controllers\Admin\AdminController;

Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TutorialController;
use App\Http\Controllers\Admin\BannerController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::put('categories/{category}/tutorials/reorder', [TutorialController::class, 'reorder'])->name('categories.tutorials.reorder');
    Route::resource('categories.tutorials', TutorialController::class);
    Route::resource('banners', BannerController::class);
});

require __DIR__.'/auth.php';
