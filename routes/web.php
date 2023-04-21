<?php

use Illuminate\Support\Facades\Auth;
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



Route::view('/about', 'about')->name('about');
Route::view('/contacts', 'contacts')->name('contacts');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::redirect('/', '/home');

Route::middleware('auth')->group(function() {
  Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
  Route::post('/cartAddOrIncrease', [App\Http\Controllers\CartController::class, 'cartAddOrIncrease'])->name('cartAddOrIncrease');
  Route::post('/cartIncrease', [App\Http\Controllers\CartController::class, 'cartIncrease'])->name('cartIncrease');
  Route::post('/cartRemoveOrDecrease', [App\Http\Controllers\CartController::class, 'cartRemoveOrDecrease'])->name('cartRemoveOrDecrease');
  Route::post('/cartRemove', [App\Http\Controllers\CartController::class, 'cartRemove'])->name('cartRemove');
  Route::get('/cartClear', [App\Http\Controllers\CartController::class, 'cartClear'])->name('cartClear');
  Route::get('film/{id}', [App\Http\Controllers\FilmController::class, 'viewFilm']);
  Route::get('/ordercreate', [App\Http\Controllers\OrderController::class, 'create'])->name('orderCreate');


});

Route::middleware('admin')->group(function() {
  Route::get('/filmmanager', [App\Http\Controllers\FilmController::class, 'index'])->name('filmManager');
  Route::post('/filmcreate', [App\Http\Controllers\FilmController::class, 'create'])->name('filmCreate');
  Route::post('/upload', [App\Http\Controllers\FileController::class, 'upload'])->name('upload');
  Route::get('/filmedit/{id}', [App\Http\Controllers\FilmController::class, 'edit'])->name('filmedit');
  Route::post('/filmedit', [App\Http\Controllers\FilmController::class, 'update'])->name('updateFilm');
  Route::get('filmdelete/{id}', [App\Http\Controllers\FilmController::class, 'delete']);
});




Auth::routes();