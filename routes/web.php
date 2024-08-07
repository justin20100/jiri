<?php

use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JirisController;
use App\Http\Controllers\ProjectsController;
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

Route::view('/', 'welcome')->name('welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::middleware('auth')->group(function () {

//    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    //    projects CRUD
    Route::resource('projects', ProjectsController::class);

    //    contacts CRUD
    Route::resource('contacts', ContactsController::class);

    //    jiris CRUD
    Route::resource('jiris', JirisController::class);
});




require __DIR__.'/auth.php';
