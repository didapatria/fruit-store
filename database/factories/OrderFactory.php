<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $customer = User::where('role', 'customer')->inRandomOrder()->first() ?? User::factory()->create(['role' => 'customer']);
        $products = Product::inRandomOrder()->limit(rand(1, 5))->get();
        $total_price = $products->sum(fn($product) => $product->price * rand(1, 3));

        return [
            'user_id' => $customer->id,
            'total_price' => $total_price,
            'status' => $this->faker->randomElement(['pending', 'completed', 'canceled']),
        ];
    }
}
