<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('items')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
    Route::get('/log', [App\Http\Controllers\ItemController::class, 'index']);
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
    // 以下新機能のRoute
    Route::post('/', [App\Http\Controllers\ItemController::class, 'store'])->name('item.store');
    Route::get('/{id}', [App\Http\Controllers\ItemController::class, 'show'])->name('item.show');
    Route::get('/{id}/edit', [App\Http\Controllers\ItemController::class, 'edit'])->name('item.edit');
    Route::put('/{id}', [App\Http\Controllers\ItemController::class, 'update'])->name('item.update');
    Route::delete('/{id}', [App\Http\Controllers\ItemController::class, 'destroy'])->name('item.destroy');
});
