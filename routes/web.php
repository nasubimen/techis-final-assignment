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
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index'])->name('item.index');
    Route::get('/log', [App\Http\Controllers\ItemController::class, 'index']);
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
    // 以下新機能のRoute
    Route::get('/{id}', [App\Http\Controllers\ItemController::class, 'show'])->name('item.show');
    Route::get('/{id}/edit', [App\Http\Controllers\ItemController::class, 'edit'])->name('item.edit');
    Route::put('/{id}', [App\Http\Controllers\ItemController::class, 'update'])->name('item.update');
    Route::delete('/{id}', [App\Http\Controllers\ItemController::class, 'destroy'])->name('item.destroy');
});

Route::prefix('types')->group(function () {
    Route::get('/', [App\Http\Controllers\TypeController::class, 'index'])->name('type.index');
    Route::get('create', [App\Http\Controllers\TypeController::class, 'create'])->name('type.create');
    Route::get('/{id}/edit', [App\Http\Controllers\TypeController::class, 'edit'])->name('type.edit');
    Route::post('store', [App\Http\Controllers\TypeController::class, 'store'])->name('type.store');
    Route::put('/{id}', [App\Http\Controllers\TypeController::class, 'update'])->name('type.update');
    Route::delete('/{id}', [App\Http\Controllers\TypeController::class, 'destroy'])->name('type.destroy');

});
Route::prefix('logs')->group(function () {
    Route::get('/', [App\Http\Controllers\LogController::class, 'index'])->name('log.index');
    Route::get('/{id}', [App\Http\Controllers\LogController::class, 'show'])->name('log.show');

});
