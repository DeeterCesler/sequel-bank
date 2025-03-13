<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('BankWelcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('account/{number}', function ($number) {
    return Inertia::render('Dashboard', [
        'lookupAccount' => $number
    ]);
})->middleware(['auth', 'verified'])->name('account.lookup');

Route::get('/accounts/{number}', [App\Http\Controllers\AccountController::class, 'show']);

Route::get('/reset', function () {
    Artisan::call('db:seed', ['--force' => true]);
    
    // Check if request wants JSON response (from cron job)
    if (request()->wantsJson() || request()->header('User-Agent') && str_contains(request()->header('User-Agent'), 'cron-job.org')) {
        return response()->json(['success' => true]);
    }
    
    // Otherwise redirect (for browser users)
    return redirect()->route('home');
});


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
