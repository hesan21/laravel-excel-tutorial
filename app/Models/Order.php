<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'delivered_at',
        'notes',
        'amount'
    ];

    protected $with = ['user'];

    /**
     * User this order Belongs To
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id',
            'user'
        );
    }

    /**
     * Order Items
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(
            OrderItem::class,
            'order_id',
            'id'
        );
    }
}
