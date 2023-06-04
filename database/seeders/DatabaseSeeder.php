<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = User::create([
            'name' => 'Aidil Baihaqi',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123')
        ]);

        Category::create([
            'name' => "Programming",
            'user_id' => $user->id
        ]);
    }
}
