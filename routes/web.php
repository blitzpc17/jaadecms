<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\indexController;

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

/*FROONTEND */

Route::get('/', [indexController::class, 'home'])->name('home');
Route::get('lotificaciones', [indexController::class, 'zonas'])->name('lotificaciones');
Route::get('contacto', [indexController::class, 'contacto'])->name('contacto');



/*BACKEND */
