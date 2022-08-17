<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $users = [
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@nicesnippets.com',
                'type' => 0,
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Super Admin User',
                'username' => 'admin',
                'email' => 'super-admin@nicesnippets.com',
                'type' => 1,
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Manager User',
                'username' => 'manager',
                'email' => 'manager@nicesnippets.com',
                'type' => 2,
                'password' => bcrypt('123456'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
