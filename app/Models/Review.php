<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'image', 'rate', 'user_id', 'food_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function food() {
        return $this->belongsTo(Food::class);
    }
}
