<?php
dd('api.php cargado');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\Beds24ApiV2Controller;

// ✅ Esta es la ruta que te falta
Route::post('/reservar', [PagoController::class, 'crearCheckout']);
Route::get('/disponibilidad/{roomId}', [Beds24ApiV2Controller::class, 'obtenerReservasConToken']);
Route::get('/prueba', function () {
    return 'funciona';
});

Route::get('/reservar', function () {
    return response()->json(['mensaje' => 'Ruta existe, pero debes usar POST'], 405);
});
