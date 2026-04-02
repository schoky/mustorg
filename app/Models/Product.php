<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'price', 'rent_price_per_day',
        'brand', 'category', 'level', 'image', 'in_stock'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
}