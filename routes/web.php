<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SharepostsController; 
use App\Http\Controllers\ProfiresController; 

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

Route::get('/', [SharepostsController::class, 'index']);

Route::get('/dashboard', [SharepostsController::class, 'index'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', UsersController::class, ['only' => ['index', 'show']]);
    Route::resource('shareposts', SharepostsController::class, ['only' => ['create','store', 'destroy']]);
    Route::resource('profires', ProfiresController::class, ['only' => ['create','store', 'edit','update']]);
});
