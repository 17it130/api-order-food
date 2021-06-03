<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['order_date', 'totalPrice', 'customer_id', 'payment_id', 'status', 'order_note', 'order_code', 'order_time'];

    public function detail() {
        return $this->hasMany(OrderDetail::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function notification() {
        return $this->hasMany(Notification::class);
    }
}
