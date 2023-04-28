<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'address'
    ];

    protected $with = [
        'menuItems'
    ];

    /**
     * Menu Items for this Restaurants
     * @return HasMany
     */
    public function menuItems(): HasMany
    {
        return $this->hasMany(
            MenuItem::class,
            'restaurant_id',
            'id'
        );
    }
}
