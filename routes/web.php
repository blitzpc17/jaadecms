<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\indexController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\zonasController;

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

Route::prefix('admin')->group(function () {
    
    Route::get('/login', function(){
        return view('Backend.modulos.login');
    })->name('login');  

    Route::post('admin/authin', [UsuariosController::class, 'authenticate'])->name('admin.auth');



    Route::middleware(['auth'])->group(function () {
     
        Route::get('home',[UsuariosController::class, 'home'])->name('admin.home');
     
        Route::get('usuarios', [UsuariosController::class, 'create'])->name('admin.users');
        Route::post('usuarios/save', [UsuariosController::class, 'save'])->name('admin.users.save');
        Route::get('usuarios/listar', [UsuariosController::class, 'listar'])->name('admin.users.listar');
        Route::get('usuarios/obtener', [UsuariosController::class, 'obtener'])->name('admin.users.ver');
        Route::get('usuarios/eliminar', [UsuariosController::class, 'eliminar'])->name('admin.users.delete');

    });




});
