<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'is_available'
    ];

    /**
     * Restaurant this Item Belongs To
     * @return BelongsTo
     */
    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(
            Restaurant::class,
            'restaurant_id',
            'id',
            'restaurant'
        );
    }
}
