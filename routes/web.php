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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [LarawowController::class, 'redirect'])->name('login');

Route::post('/user/wow/refresh', [LarawowController::class, 'WoWUserRefresh'])->name('wow.user.refresh');

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
