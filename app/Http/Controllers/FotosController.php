<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FotosController extends Controller
{
    public function index()
    {
        return view('fotos'); // Carga `resources/views/fotos.blade.php`
    }
}