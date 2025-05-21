<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class ReservaController extends Controller
{
    // OPCIONAL: método usado si reservas antes del pago
    public function reservar(Request $request)
    {
        $validated = $request->validate([
            'roomId' => 'required|integer',
            'arrival' => 'required|date',
            'departure' => 'required|date|after:arrival',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email',
            'mobile' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'postCode' => 'nullable|string',
            'country' => 'nullable|string',
        ]);

        $bookingData = [
            [
                'roomId' => $validated['roomId'],
                'status' => 'confirmed',
                'arrival' => $validated['arrival'],
                'departure' => $validated['departure'],
                'numAdults' => 2,
                'numChildren' => 0,
                'title' => 'Sr.',
                'firstName' => $validated['firstName'],
                'lastName' => $validated['lastName'],
                'email' => $validated['email'],
                'mobile' => $validated['mobile'] ?? '',
                'address' => $validated['address'] ?? '',
                'city' => $validated['city'] ?? '',
                'state' => $validated['state'] ?? '',
                'postCode' => $validated['postCode'] ?? '',
                'country' => $validated['country'] ?? '',
            ]
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-API-KEY' => env('BEDS24_API_KEY'),
        ])->post('https://api.beds24.com/json/bookings', $bookingData);

        if ($response->successful()) {
            return response()->json(['success' => true, 'message' => 'Reserva creada correctamente.']);
        }

        return response()->json(['success' => false, 'message' => 'Error al crear la reserva.', 'details' => $response->json()], 500);
    }

    // NUEVO: se llama después del pago exitoso en Stripe
    public function confirmarReserva(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $sessionId = $request->get('session_id');
        if (!$sessionId) {
            return redirect('/')->with('error', 'Sesión de pago no encontrada.');
        }

        try {
            $session = Session::retrieve($sessionId);
            $metadata = $session->metadata ?? null;

            if (!$metadata) {
                return redirect('/')->with('error', 'Datos de reserva no encontrados.');
            }

            $bookingData = [[
                'roomId' => $metadata->roomId,
                'status' => 'confirmed',
                'arrival' => $metadata->arrival,
                'departure' => $metadata->departure,
                'numAdults' => 2,
                'numChildren' => 0,
                'title' => 'Sr.',
                'firstName' => $metadata->firstName,
                'lastName' => $metadata->lastName,
                'email' => $metadata->email,
                'mobile' => $metadata->telefono ?? '',
            ]];

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-API-KEY' => env('BEDS24_API_KEY'),
            ])->post('https://api.beds24.com/json/bookings', $bookingData);

            if ($response->successful()) {
                return view('checkout.success')->with('message', 'Reserva realizada con éxito.');
            }

            return view('checkout.cancel')->with([
                'error' => 'El pago se ha hecho, pero no se pudo crear la reserva en Beds24.',
                'details' => $response->json()
            ]);

        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Error al confirmar la reserva: ' . $e->getMessage());
        }
    }
}
