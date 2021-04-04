<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'food_id', 'price', 'shop_id', 'quantity'];

    public function order() {
        return $this->belongsToMany(Order::class, 'order_id');
    }

    public function food() {
        return $this->belongsTo(Food::class, 'food_id');
    }
}
