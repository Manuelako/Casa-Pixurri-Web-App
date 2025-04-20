<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartamento extends Model
{
    use HasFactory;

    protected $table = 'apartamentos'; // Nombre de la tabla en la BD

    protected $fillable = [
        'nombre',
        'descripcion',
        'habitaciones',
        'banos',
        'capacidad',
        'duplex',
        'imagen',
    ]; // Columnas que se pueden asignar masivamente

    /**
     * Relación con el modelo Imagen.
     * Un apartamento puede tener varias imágenes.
     */
    public function imagenes()
    {
        return $this->hasMany(Imagen::class, 'apartamento_id');
    }
}
