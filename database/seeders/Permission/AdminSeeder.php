<?php

namespace Database\Seeders\Permission;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->withRole('admin')->create([
            "name" => "Dida Patria",
            "email" => "didapatria@sidiktalent.com",
            "password" => Hash::make("FruitStore@2025"),
        ]);
    }
}