<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => Arr::random(['placed', 'completed', 'cancelled', 'failed']),
            'delivered_at' => Carbon::parse(fake()->dateTime())->toDateTimeString(),
            'notes' => fake()->boolean(50) ? fake()->sentence() : null,
            'amount' => fake()->randomFloat(2, 1, 100)
        ];
    }
}
