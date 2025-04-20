<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ApartamentoController;
use App\Http\Controllers\ContactoController; // Corregido el nombre
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FotosController; // ✅ Importamos el nuevo controlador de fotos

// ✅ Página principal carga `welcome.blade.php`
Route::get('/', function () {
    return view('welcome'); 
})->name('home');

// ✅ Cuando se haga clic en el cubo, redirige al menú
Route::get('/menu', [MenuController::class, 'index'])->name('menu');

Route::get('/apartamentos', [ApartamentoController::class, 'index'])->name('apartamentos');
Route::get('/apartamentos/{id}', [ApartamentoController::class, 'detalle'])->name('apartamentos.detalle');

// ✅ Ruta para la vista de contacto con controlador
Route::get('/contacto', [ContactoController::class, 'index'])->name('contacto');


// ✅ Ruta para enviar el formulario de contacto


// ✅ Ruta para la galería de fotos (usando un controlador en lugar de Closure)
Route::get('/fotos', [FotosController::class, 'index'])->name('fotos');

// ✅ Rutas para gestionar las reservas
Route::get('/reservas', [ReservationController::class, 'index'])->name('reservas.index');
Route::get('/reservas/crear', [ReservationController::class, 'create'])->name('reservas.create');
Route::post('/reservas', [ReservationController::class, 'store'])->name('reservas.store');
