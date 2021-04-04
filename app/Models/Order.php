<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['order_date', 'totalPrice', 'customer_id', 'payment_id', 'status'];

    public function detail() {
        return $this->hasMany(OrderDetail::class);
    }

    public function user() {
        return $this->belongsToMany(User::class, 'customer_id');
    }
}
