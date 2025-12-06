<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'product_id',
        'user_name',
        'game_id',
        'server_id',
        'phone',
        'quantity',
        'total_price',
        'payment_method',
        'payment_proof',
        'status',
    ];
    

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected static function boot()
    {
    parent::boot();

    static::creating(function ($order) {
        if (empty($order->order_code)) {
            $order->order_code = strtoupper(Str::random(8));
        }
    });
}
}
