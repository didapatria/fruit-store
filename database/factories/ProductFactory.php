<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Permission\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        static $usedCombinations = [];
        $vendor = Role::where('name', 'vendor')->first()?->users()->inRandomOrder()->first() ?? User::factory()->create()->assignRole('vendor');
        $fruits = [
            'Apple', 'Banana', 'Orange', 'Mango', 'Strawberry', 'Grapes', 'Watermelon', 'Pineapple', 'Papaya', 'Cherry',
            'Blueberry', 'Raspberry', 'Blackberry', 'Lemon', 'Lime', 'Peach', 'Plum', 'Apricot', 'Coconut', 'Avocado',
            'Kiwi', 'Pomegranate', 'Fig', 'Cranberry', 'Melon', 'Guava', 'Passion Fruit', 'Tangerine', 'Persimmon', 'Lychee',
        ];
        $types = ['Fresh', 'Organic', 'Imported', 'Local', 'Premium', 'Juicy', 'Sweet', 'Ripe', 'Exotic', 'Sun-ripened',];
        do {
            $type = $this->faker->randomElement($types);
            $fruit = $this->faker->randomElement($fruits);
            $productName = "$type $fruit";
        } while (in_array($productName, $usedCombinations) && count($usedCombinations) < count($types) * count($fruits));

        $usedCombinations[] = $productName;

        $descriptions = [
            "Handpicked and naturally grown for the best taste.",
            "Sourced from the finest farms to ensure top quality.",
            "Perfectly ripe and packed with essential nutrients.",
            "Deliciously sweet and ready to eat anytime.",
            "A great addition to smoothies, desserts, or just as a snack.",
            "Harvested at peak freshness for maximum flavor.",
            "A juicy and refreshing treat for any occasion.",
            "Loaded with vitamins and antioxidants to boost your health.",
            "Naturally sun-ripened for the best possible taste.",
            "A must-have for a healthy and balanced diet."
        ];

        return [
            'user_id' => $vendor->id,
            'name' => $productName,
            'description' => $this->faker->randomElement($descriptions),
            'price' => $this->faker->randomFloat(2, 1, 20),
            'stock' => $this->faker->numberBetween(10, 100),
        ];
    }
}
