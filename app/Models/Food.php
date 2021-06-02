<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $table = "foods";

    protected $fillable = ['name', 'images', 'price', 'description', 'shop_id', 'category_id'];

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

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function reviews() {
        return $this->belongsTo(Review::class);
    }

    public function getSumOfRating() {
        return $this->reviews()->sum('rate');
    }

    public function createTags($str) {
        $tagIds = [];

        foreach ($str as $tag) {
            $newTag = Tag::firstOrCreate([
                'name' => ucwords(trim($tag))
            ]);

            $tagIds[] = $newTag->id;
        }

        $this->tags()->sync($tagIds);
    }

    public function review() {
        return $this->hasMany(Review::class, 'food_id');
    }
}
