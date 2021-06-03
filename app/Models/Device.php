<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = ['device_id', 'push_token', 'device_type', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
