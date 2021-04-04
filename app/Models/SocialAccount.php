<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'social_id', 'social_provider'];

    public function user() {
        return $this->belongsToMany(User::class, 'user_id');
    }
}
