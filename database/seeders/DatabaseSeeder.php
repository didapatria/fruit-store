<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Dida Patria',
            'email' => 'didapatria@sidiktalent.com',
            'role' => 'admin',
        ]);

        User::factory(10)->create();

        Product::factory(20)->create();

        Order::factory(10)->create()->each(function ($order) {
            $items = Product::inRandomOrder()->take(rand(1, 5))->get();
            $total_price = 0;

            foreach ($items as $item) {
                $quantity = rand(1, 5);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'quantity' => $quantity,
                    'price' => $item->price
                ]);

                $total_price += $item->price * $quantity;
            }

            $order->update(['total_price' => $total_price]);
        });
    }
}
