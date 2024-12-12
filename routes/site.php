<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;

Route::get('/', [SiteController::class, 'homepage'])->name('homepage');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/login', [SiteController::class, 'login'])->name('login');
Route::get('/register', [SiteController::class, 'register'])->name('register');
Route::get('/what-we-do', [SiteController::class, 'whatWeDo'])->name('what_we_do');
Route::get('/contact', [SiteController::class, 'contact'])->name('contact');
