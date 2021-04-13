<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $table = "foods";

    protected $fillable = ['name', 'images', 'price', 'description', 'rating', 'shop_id', 'category_id'];

    public function order_detail()
    {
        return $this->hasOne(OrderDetail::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function shop()
    {
        return $this->belongsTo(User::class);
    }
}
