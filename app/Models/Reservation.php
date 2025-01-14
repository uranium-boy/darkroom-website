<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_time',
        'end_time',
        'user_id',
        'darkroom_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function darkroom()
    {
        return $this->belongsTo(Darkroom::class);
    }
}
