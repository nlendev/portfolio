<?php

use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\HomeController;



Route::get('/', HomeController::class)->name('home');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});
Route::get('projets', [ProjectController::class, 'index'])->name('projects.index');
Route::get('projets/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');
Route::inertia('a-propos', 'About')->name('about');
Route::inertia('mentions-legales', 'Legal')->name('legal');
Route::get('contact', [ContactController::class, 'create'])->name('contact');
Route::post('contact', [ContactController::class, 'store'])
    ->middleware('throttle:3,1')
    ->name('contact.store');




Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('projets', AdminProjectController::class)
        ->except('show')
        ->names('projects')
        ->parameters(['projets' => 'project']);
        Route::patch('projets/{project}/publication', [AdminProjectController::class, 'togglePublished'])
    ->name('projects.toggle-published');
});





require __DIR__.'/settings.php';
