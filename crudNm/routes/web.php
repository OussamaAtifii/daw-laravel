<?php

use App\Http\Controllers\ContactoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Models\Post;
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
    $posts = Post::where('estado', 'publicado')->orderBy('id', 'desc')->paginate(5);
    return view('welcome', compact('posts'));
})->name('home');

Route::resource('posts', PostController::class);
Route::resource('tags', TagController::class)->except('show');

Route::get('contacto', [ContactoController::class, 'showForm'])->name('mail.show');
Route::post('contacto', [ContactoController::class, 'sendForm'])->name('mail.send');
