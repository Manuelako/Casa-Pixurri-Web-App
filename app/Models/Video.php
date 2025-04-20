<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    // Especifica los campos que se pueden llenar con asignación masiva
    protected $fillable = ['season', 'video_path'];
}