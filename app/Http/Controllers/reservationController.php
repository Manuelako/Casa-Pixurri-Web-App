<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class PagoController extends Controller
{
    public function crearCheckout(Request $request)
    {
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

        return response()->json(['url' => $session->url]);
    }

    public function reservaCompletada(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = StripeSession::retrieve($request->get('session_id'));

        if ($session->payment_status !== 'paid') {
            return redirect('/')->with('error', 'El pago no se completó.');
        }

        // Extraer datos enviados como metadata
        $meta = $session->metadata;
        $roomId = $meta->roomId;
        $fechas = explode(' to ', $meta->fechas);
        $nombre = $meta->nombre;
        $apellido = $meta->apellido;
        $email = $meta->email;
        $telefono = $meta->telefono;

        // Crear la reserva en Beds24
        $postData = [
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
        ];

        $token = config('services.beds24.token'); // define esto en config/services.php

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'token' => $token
        ])->post('https://beds24.com/api/v2/bookings', $postData);

        if ($response->successful()) {
            return redirect('/')->with('success', 'Reserva confirmada con éxito.');
        } else {
            return redirect('/')->with('error', 'Pago hecho pero no se pudo registrar la reserva en Beds24.');
        }
    }
}
