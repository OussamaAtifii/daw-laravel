<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Socialite\GithubController;
use App\Http\Controllers\TagController;
use App\Livewire\ShowFilms;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('tags', TagController::class)->except('show');

    Route::get('films', ShowFilms::class)->name('films.show');
});

Route::get(
    '/auth/github/redirect',
    [GithubController::class, 'redirect']
)->name('github.redirect');

Route::get(
    '/auth/github/callback',
    [GithubController::class, 'callback']
)->name('github.callback');
