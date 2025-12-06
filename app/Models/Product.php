<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Kalau tidak pakai timestamps
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
    ];

    // Relasi ke Order
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
