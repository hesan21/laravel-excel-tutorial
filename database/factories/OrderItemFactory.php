<?php

namespace Database\Factories;

use App\Models\MenuItem;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_count' => rand(1,5),
            'order_id' => Arr::random(Order::all()->pluck('id')->toArray()),
            'item_id' => Arr::random(MenuItem::all()->pluck('id')->toArray()),
        ];
    }
}
