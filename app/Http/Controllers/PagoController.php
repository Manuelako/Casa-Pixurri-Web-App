<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class PagoController extends Controller
{
    public function crearCheckout(Request $request)
    {
        Log::info("🎯 Iniciando creación de sesión de pago con datos:", $request->all());

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Reserva Casa Pixurri',
                    ],
                    'unit_amount' => 10000, // 100.00€ en céntimos
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/reserva/completada') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => url('/'),
            'metadata' => $request->only([
                'roomId', 'fechas', 'nombre', 'apellido', 'email', 'telefono'
            ]),
        ]);

        Log::info("✅ Sesión de Stripe creada: " . $session->id);

        return response()->json(['url' => $session->url]);
    }

    public function reservaCompletada(Request $request)
    {
        Log::info("👉 Entrando en reservaCompletada()");

        Stripe::setApiKey(config('services.stripe.secret'));

        $sessionId = $request->get('session_id');
        Log::info("📦 session_id recibido:", ['session_id' => $sessionId]);

        if (!$sessionId) {
            Log::error("❌ No se recibió session_id en la URL");
            return redirect('/')->with('error', 'Sesión de pago no encontrada.');
        }

        try {
            $session = StripeSession::retrieve($sessionId);
            Log::info("✅ Stripe Session recuperada:", ['session' => $session->id]);

            if ($session->payment_status !== 'paid') {
                Log::warning("⚠️ El pago no fue exitoso:", ['status' => $session->payment_status]);
                return redirect('/')->with('error', 'El pago no se completó.');
            }

            $meta = $session->metadata;
            Log::info("📦 Metadata de Stripe:", (array)$meta);

            $roomId = $meta->roomId;
            $fechas = explode(' to ', $meta->fechas);
            $nombre = $meta->nombre;
            $apellido = $meta->apellido;
            $email = $meta->email;
            $telefono = $meta->telefono;

            $postData = [[
                "roomId" => $roomId,
                "status" => "confirmed",
                "arrival" => $fechas[0],
                "departure" => $fechas[1],
                "adults" => 2,
                "childAges" => [],
                "firstname" => $nombre,
                "lastname" => $apellido,
                "email" => $email,
                "mobile" => $telefono,
                "country" => "ES"
            ]];

            $token = config('services.beds24.token');
            Log::info("🔐 Token que se está usando:", ['token' => $token]);
            Log::info("📨 Enviando datos a Beds24:", $postData);
            // Se hace la petición a Beds24 para registrar la reserva
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'token' => $token
            ])->post('https://beds24.com/api/v2/bookings', $postData);

            // Si la respuesta es correcta, se confirma la reserva
            if ($response->successful()) {
                Log::info("✅ Reserva registrada con éxito en Beds24:", $response->json());
                return redirect('/')->with('success', 'Reserva confirmada con éxito.');
            } else {
                Log::error("❌ Error al registrar reserva en Beds24", $response->json());
                return redirect('/')->with('error', 'Pago hecho pero no se pudo registrar la reserva en Beds24.');
            }

        } catch (\Exception $e) {
            // Captura errores y los muestra en los logs
            Log::error("❌ Excepción en reservaCompletada:", ['error' => $e->getMessage()]);
            return redirect('/')->with('error', 'Error al confirmar la reserva: ' . $e->getMessage());
        }
    }
}
