<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Darkroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_operational'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
