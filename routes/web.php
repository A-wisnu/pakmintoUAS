<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SecretCodeController;
use App\Http\Controllers\DebugController;
use Illuminate\Support\Facades\Auth;

// Debug routes
Route::get('/debug', function() {
    return '<h1>Debug Page</h1><p>Laravel is working correctly if you see this.</p>';
});
Route::get('/debug/view', [DebugController::class, 'testView']);
Route::get('/debug/html', [DebugController::class, 'plainHtml']);
Route::get('/debug/blade', [DebugController::class, 'rawBlade']);

// Main routes
Route::get('/', function() {
    return view('welcome');
})->name('home');

// Home route also handles /home URL path
Route::get('/home', function() {
    return view('welcome');
})->name('home.alt');

// Authentication routes
Auth::routes();

// Secret code authentication
Route::get('/login/secret-code', [SecretCodeController::class, 'showLoginForm'])->name('login.secret-code');
Route::post('/login/secret-code', [SecretCodeController::class, 'login'])->name('login.secret-code.submit');

// Meme routes
Route::resource('memes', MemeController::class)->except(['store']);
Route::post('/memes', [MemeController::class, 'store'])->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class)->name('memes.store');
Route::get('/feed', [MemeController::class, 'feed'])->name('memes.feed');
Route::get('/reels', [MemeController::class, 'reels'])->name('memes.reels');
Route::post('/memes/{meme}/like', [MemeController::class, 'like'])->name('memes.like');

// Profile routes
Route::resource('profile', ProfileController::class);
Route::get('/user/{user}/profile', [ProfileController::class, 'showByUser'])->name('user.profile');

// Secret code routes
Route::get('/secret-codes', [SecretCodeController::class, 'index'])->name('secret-codes.index');
Route::post('/secret-codes/generate', [SecretCodeController::class, 'generate'])->name('secret-codes.generate');
Route::post('/secret-codes/{secretCode}/invalidate', [SecretCodeController::class, 'invalidate'])->name('secret-codes.invalidate');

// Static pages
Route::get('/about', function() {
    return view('pages.about');
})->name('about');

Route::get('/contact', function() {
    return view('pages.contact');
})->name('contact');

Route::get('/terms', function() {
    return view('pages.terms');
})->name('terms');

Route::get('/privacy', function() {
    return view('pages.privacy');
})->name('privacy');
