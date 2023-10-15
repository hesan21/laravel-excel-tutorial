<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_count',
        'item_id'
    ];

    /**
     * Order
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(
            Order::class,
            'order_id',
            'id',
            'order'
        );
    }

    /**
     * Item
     * @return BelongsTo
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(
            MenuItem::class,
            'item_id',
            'id',
            'item'
        );
    }
}
