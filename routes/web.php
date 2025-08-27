<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/uitleg', [App\Http\Controllers\ExplanationController::class, 'index'])->name('explanation.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/emergency', function () {
        return view('emergency.index');
    })->name('emergency.index');

    Route::post('/emergency', [App\Http\Controllers\EmergencyController::class, 'store'])->name('emergency.store');
    Route::get('/emergency/{emergency}', [App\Http\Controllers\EmergencyController::class, 'show'])->name('emergency.show');
    Route::patch('/emergency/{emergency}/resolve', [App\Http\Controllers\EmergencyController::class, 'resolve'])->name('emergency.resolve');
    Route::patch('/emergency/{emergency}/cancel', [App\Http\Controllers\EmergencyController::class, 'cancel'])->name('emergency.cancel');
});

    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])   
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    
    // Locations routes
    Route::get('locations', \App\Livewire\Locations\Index::class)->name('locations.index');
    
    // Feedback routes
    Route::get('feedback', \App\Livewire\Feedback\Index::class)->name('feedback.index');
    
    // Admin routes
    Route::get('admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    
});

require __DIR__.'/auth.php';
