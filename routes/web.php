<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FavoritoController;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return Inertia::render('Dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/personaje/{id}', function ($id) {
    return Inertia::render('personaje', [
        'id' => $id
    ]);
})->name('personaje');

Route::middleware(['auth:sanctum', 'verified'])->post('/agregarFavorito', [FavoritoController::class, 'store'])->name('add.fav');
Route::middleware(['auth:sanctum', 'verified'])->get('/favoritos', [FavoritoController::class, 'index'])->name('favoritos');