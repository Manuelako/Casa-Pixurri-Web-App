<?php

namespace App\Http\Controllers;

use App\Models\Apartamento;

class VideoController extends Controller
{
    public function index()
    {
        // Obtener los apartamentos
        $apartamentos = Apartamento::all();

        // Enviar los apartamentos a la vista
        return view('welcome', compact('apartamentos'));
    }
}
