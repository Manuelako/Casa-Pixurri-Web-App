<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apartamento; // Importa el modelo de Apartamentos

class ApartamentoController extends Controller
{
    /**
     * Muestra la lista de apartamentos.
     */
    public function index()
    {
        $apartamentos = Apartamento::all(); // Obtiene todos los apartamentos de la BD
        return view('apartamentos', compact('apartamentos')); // Pasa los datos a la vista
    }

    /**
     * Muestra el detalle de un apartamento específico.
     */
    public function detalle($id)
    {
        $apartamento = Apartamento::findOrFail($id); // Busca el apartamento por su ID
        return view('detalle', compact('apartamento')); // Pasa el apartamento a la vista de detalle
    }
}
