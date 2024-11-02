<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bookings; 

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'quantity',
        'id_bookings',
    ];

    public function booking()
    {
        return $this->belongsTo(Bookings::class, 'id_bookings');
    }
}
