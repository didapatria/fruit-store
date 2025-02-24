<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Permission\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $customerRole = Role::where('name', 'customer')->first();
        $vendorRole = Role::where('name', 'vendor')->first();

        $user = $customerRole?->users()->inRandomOrder()->first() 
            ?? User::factory()->create()->assignRole('customer');
        $products = Product::where('user_id', '!=', $user->id)->inRandomOrder()->limit(rand(1, 5))->get();
        if ($products->isEmpty()) {
            $vendor = $vendorRole?->users()->where('id', '!=', $user->id)->inRandomOrder()->first() ?? User::factory()->create()->assignRole('vendor');
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
