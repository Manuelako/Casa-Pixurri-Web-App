<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ApartamentoController;
use App\Http\Controllers\ContactoController; // Corregido el nombre
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FotosController; // ✅ Importamos el nuevo controlador de fotos
use App\Http\Controllers\Beds24Controller;
use App\Http\Controllers\Beds24ApiV2Controller;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\PagoController;
Route::post('/crear-checkout-session', [PagoController::class, 'crearCheckout']);
Route::get('/reserva/completada', [PagoController::class, 'reservaCompletada']);
Route::post('/crear-checkout-session', [PagoController::class, 'crearCheckout']);
Route::get('/reserva/completada', [PagoController::class, 'reservaCompletada']);
use App\Http\Controllers\DisponibilidadController;


Route::post('/reservar', [PagoController::class, 'crearCheckout']);



Route::get('/checkout/success', [PagoController::class, 'reservaCompletada'])->name('checkout.success');


Route::get('/reserva/completada', [PagoController::class, 'reservaCompletada'])->name('reserva.completada');



Route::post('/crear-checkout-session', [PagoController::class, 'crearCheckout']);
Route::get('/reserva/completada', [PagoController::class, 'reservaCompletada']);

Route::get('/disponibilidad/{roomId}', [Beds24ApiV2Controller::class, 'obtenerReservasConToken']);




Route::get('/generar-token', [Beds24ApiV2Controller::class, 'generarTokenDesdeInvite']);

use Illuminate\Support\Facades\Http;

Route::get('/disponibilidad/{roomId}', function ($roomId) {
    $token = '7Mv3PDwkIEJEDNyV7IAPYgAbgLSosBFdTuuFV234kuoBatdoaxg9Wjr2vkTCLGeeY7x1mApITaYQNHkQ5J/dt7W5UFnM82RechntPaXpPoVZ3LphCclx/VO8nGSQJ0kcCFYd13C4Cn9Z11j39N8g2/8Q1wy3QKnnkiGtC3JWaWs=';

    $propertyId = 274686; // ID de Casa Pixurri Playa Xeraco
    $startDate = now()->format('Y-m-d');
    $endDate = now()->addMonths(6)->format('Y-m-d');

    $response = Http::withHeaders([
        'accept' => 'application/json',
        'token' => $token,
    ])->get('https://beds24.com/api/v2/inventory/rooms/availability', [
        'roomId' => $roomId,
        'propertyId' => $propertyId,
        'startDate' => $startDate,
        'endDate' => $endDate,
    ]);

    if ($response->successful()) {
        $data = $response->json();
        $result = [];

        foreach ($data['data'] as $room) {
            $result[$room['roomId']] = [];
            foreach ($room['availability'] as $fecha => $disponible) {
                $result[$room['roomId']][$fecha] = [
                    'availability' => $disponible ? 1 : 0
                ];
            }
        }

        return response()->json($result);
    } else {
        return response()->json(['error' => 'No se pudo obtener la disponibilidad'], 500);
    }
});



Route::get('/disponibilidad/{roomId}', [Beds24ApiV2Controller::class, 'disponibilidad']);
Route::get('/beds24/token', [Beds24ApiV2Controller::class, 'obtenerTokenDesdeInvite']);



Route::get('/reservas', [Beds24ApiV2Controller::class, 'obtenerReservasConToken']);
Route::get('/disponibilidad/{roomId}', [Beds24ApiV2Controller::class, 'disponibilidad']);



Route::get('/disponibilidad/{roomId}', [Beds24ApiV2Controller::class, 'obtenerReservasConToken']);



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


