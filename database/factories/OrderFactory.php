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
        $user = User::where('role', ['customer', 'vendor'])->inRandomOrder()->first() ?? User::factory()->create(['role' => ['customer', 'vendor']]);
        $products = Product::where('user_id', '!=', $user->id)->inRandomOrder()->limit(rand(1, 5))->get();
        if ($products->isEmpty()) {
            $vendor = User::where('role', 'vendor')->where('id', '!=', $user->id)->inRandomOrder()->first() ?? User::factory()->create(['role' => 'vendor']);
            $products = Product::factory()->count(rand(1, 5))->create(['user_id' => $vendor->id]);
        }
        $total_price = $products->sum(fn($product) => $product->price * rand(1, 3));

        return [
            'user_id' => $user->id,
            'total_price' => $total_price,
            'status' => $this->faker->randomElement(['pending', 'completed', 'canceled']),
        ];
    }
}
