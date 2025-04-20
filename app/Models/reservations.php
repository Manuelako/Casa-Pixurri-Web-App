<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    protected $fillable = [
        'user_id',
        'check_in',
        'check_out',
        'guests',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
