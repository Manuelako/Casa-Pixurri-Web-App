<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Beds24ApiV2Controller extends Controller
{
    public function obtenerReservasConToken($roomId)
    {
        // ✅ Solo el token de acceso actual (NO el refresh token)
        $token = 'tD4XWincMT0gKd6/IOLnHOqcj3Gpy0RYfgPhG+2LIOSDCfJils0tavm0P+rhkonaZwx52cotEw5hWac4gZlVaQ8hY2BBu5eeHK7FyC0t4F4N6EzKBGW/HyOKgzdHJX9TLNVyWqqYL/3SdGpDnE4AMj2a7KMk4iTbS26niTO4OrQ=';

        $propertyId = 274686;
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
    }
}
