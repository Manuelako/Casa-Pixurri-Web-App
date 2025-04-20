<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;

    protected $table = 'imagenes';

    protected $fillable = ['apartamento_id', 'ruta'];

    public function apartamento()
    {
        return $this->belongsTo(Apartamento::class, 'apartamento_id');
    }
}
