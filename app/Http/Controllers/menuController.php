<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apartamento;

class MenuController extends Controller
{
    public function index()
    {
        $apartamentos = Apartamento::all(); // Obtener apartamentos
        return view('menu', compact('apartamentos'));
    }
}
