<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LarawowController;
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

Route::get('/', [LarawowController::class, 'home'])->name('home');

Route::get('/login', [LarawowController::class, 'redirect'])->name('login');

Route::post('/user/accounts', [LarawowController::class, 'getAccounts'])->name('getAccounts');

Route::post('/user/protected-character/{character}', [LarawowController::class, 'getProtectedCharacter'])->name('getProtectedCharacter');

Route::post('/user/collection/index', [LarawowController::class, 'getCurrentCollectionsIndex'])->name('getCurrentCollectionsIndex');

Route::post('/user/collection/mounts', [LarawowController::class, 'getCurrentMounts'])->name('getCurrentMounts');

Route::post('/mounts', [LarawowController::class, 'getAllMounts'])->name('getAllMounts');

Route::get('/LaraWoW/callback', [LarawowController::class, 'get'])
    ->name('callback');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
