<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user1 = User::factory()
            ->create([
                'firstname' => 'adminFirst',
                'lastname' => 'adminLast',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
            ]);

        $user2 = User::factory()
            ->create([
                'firstname' => 'Justin',
                'lastname' => 'Vincent',
                'email' => 'justinvincent@gmail.com',
                'password' => bcrypt('admin'),
            ]);

        $users = collect([$user1, $user2]);
    }
}
