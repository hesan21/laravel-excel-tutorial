<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\OrderItem;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 10 Restaurants. Each Restaurant may have menu items ranging between 5 and 30
        Restaurant::factory(10)->hasMenuItems(rand(5, 30))->create();
        $this->command->info('Restaurant Seeder Completed');

        // 100 Users. Each User may have more than 1 orders.
        User::factory(100)->hasOrders(rand(1,100))->create();
        $this->command->info('User Seeder Completed');

        // Order Items
        OrderItem::factory(200)->create();
        $this->command->info('Order Items Seeder Completed');
    }
}
