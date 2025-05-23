<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable=[
        'user_id',
        'car_id',
        'start_date',
        'end_date',
        'total_cost',
        'status'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }    
    
    public function car() {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }
}
