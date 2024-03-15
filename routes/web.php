<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\indexController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\zonasController;
use App\Http\Controllers\sliderController;
use App\Http\Controllers\servicioscontroller;
use App\Http\Controllers\variablesglobalescontroller;
use App\Http\Controllers\contactocontroller;

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

Route::get('zonas', [indexController::class, 'zonas'])->name('zonas');
Route::get('zonas/info', [indexController::class, 'zonasinfo'])->name('zonas.info');

Route::post('contacto/save', [indexcontroller::class, 'saveComentario'])->name('contacto.save');

/*BACKEND */

Route::prefix('admin')->group(function () {
    
    Route::get('/login', function(){
        return view('Backend.modulos.login');
    })->name('login');  

    Route::post('admin/authin', [UsuariosController::class, 'authenticate'])->name('admin.auth');



    Route::middleware(['auth'])->group(function () {
     
        Route::get('home',[UsuariosController::class, 'home'])->name('admin.home');
     
        //usuarios
        Route::get('usuarios', [UsuariosController::class, 'create'])->name('admin.users');
        Route::post('usuarios/save', [UsuariosController::class, 'save'])->name('admin.users.save');
        Route::get('usuarios/listar', [UsuariosController::class, 'listar'])->name('admin.users.listar');
        Route::get('usuarios/obtener', [UsuariosController::class, 'obtener'])->name('admin.users.ver');
        Route::get('usuarios/eliminar', [UsuariosController::class, 'eliminar'])->name('admin.users.delete');

        //zonas
        Route::get('zonas', [zonasController::class, 'create'])->name('admin.zonas');
        Route::post('zonas/save', [zonasController::class, 'save'])->name('admin.zonas.save');
        Route::get('zonas/listar', [zonasController::class, 'listar'])->name('admin.zonas.listar');
        Route::get('zonas/obtener', [zonasController::class, 'obtener'])->name('admin.zonas.ver');
        Route::get('zonas/eliminar', [zonasController::class, 'eliminar'])->name('admin.zonas.delete');    
        
        //servicios
        Route::get('servicios', [serviciosController::class, 'create'])->name('admin.servicios');
        Route::post('servicios/save', [serviciosController::class, 'save'])->name('admin.servicios.save');
        Route::get('servicios/listar', [serviciosController::class, 'listar'])->name('admin.servicios.listar');
        Route::get('servicios/obtener', [serviciosController::class, 'obtener'])->name('admin.servicios.ver');
        Route::get('servicios/eliminar', [serviciosController::class, 'eliminar'])->name('admin.servicios.delete');    

        //slider
        Route::get('slider', [sliderController::class, 'create'])->name('admin.slider');
        Route::post('slider/save', [sliderController::class, 'save'])->name('admin.slider.save');
        Route::get('slider/listar', [sliderController::class, 'listar'])->name('admin.slider.listar');
        Route::get('slider/obtener', [sliderController::class, 'obtener'])->name('admin.slider.ver');
        Route::get('slider/eliminar', [sliderController::class, 'eliminar'])->name('admin.slider.delete'); 
        
        
         //datos
         Route::get('datos', [variablesglobalescontroller::class, 'create'])->name('admin.datos');
         Route::post('datos/save', [variablesglobalesController::class, 'save'])->name('admin.datos.save');
         Route::get('datos/listar', [variablesglobalesController::class, 'listar'])->name('admin.datos.listar');
         Route::get('datos/obtener', [variablesglobalesController::class, 'obtener'])->name('admin.datos.ver');
         Route::get('datos/eliminar', [variablesglobalesController::class, 'eliminar'])->name('admin.datos.delete'); 
         

        //contacto


        Route::get('contacto', [contactocontroller::class, 'create'])->name('admin.contacto');
        Route::get('contacto/listar',  [contactocontroller::class, 'listar'])->name('admin.contacto.listar');
        Route::get('contacto/obtener', [contactocontroller::class, 'obtener'])->name('admin.contacto.ver');

    });




});
