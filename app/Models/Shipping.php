<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'building_number',
        'shipping_status',
        'shipping_date',
        'courier_id',
        'courier_schedule',
        'tracking_number'
    ];

    public function courier()
    {
        return $this->belongsTo(User::class, 'courier_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_code', 'order_code');
    }
}