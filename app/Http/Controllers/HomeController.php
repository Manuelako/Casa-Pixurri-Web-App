<?php 
namespace App\Http\Controllers;

use App\Models\Apartamento;

class HomeController extends Controller
{
    public function index()
    {
        // Obtiene todos los apartamentos de la base de datos
        $apartamentos = Apartamento::all();

        // Pasa los datos a la vista
        return view('home', compact('apartamentos'));
    }
}
