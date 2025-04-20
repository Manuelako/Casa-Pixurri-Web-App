<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all(); // Obtiene todas las reservas
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        return view('reservations.create'); // Retorna la vista para crear una reserva
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
            'status' => 'required|in:pendiente,confirmada,cancelada',
        ]);

        Reservation::create($validated);

        return redirect()->route('reservations.index')->with('success', 'Reserva creada con éxito.');
    }
}
