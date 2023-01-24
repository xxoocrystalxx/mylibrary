<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@nicesnippets.com',
                'type' => 1,
                'profile_image' => '202208171428ace.jpg',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Manager',
                'username' => 'manager',
                'email' => 'manager@nicesnippets.com',
                'type' => 2,
                'profile_image' => '202208171439flagStraw.jpg',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'User3',
                'username' => 'user3',
                'email' => 'user3@nicesnippets.com',
                'type' => 0,
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'User4',
                'username' => 'user4',
                'email' => 'user4@nicesnippets.com',
                'type' => 0,
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'User5',
                'username' => 'user5',
                'email' => 'user5@nicesnippets.com',
                'type' => 0,
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'User6',
                'username' => 'user6',
                'email' => 'user6@nicesnippets.com',
                'type' => 0,
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'User7',
                'username' => 'user7',
                'email' => 'user7@nicesnippets.com',
                'type' => 0,
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'User8',
                'username' => 'user8',
                'email' => 'user8@nicesnippets.com',
                'type' => 0,
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'User9',
                'username' => 'user9',
                'email' => 'user9@nicesnippets.com',
                'type' => 0,
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'User10',
                'username' => 'user10',
                'email' => 'user10@nicesnippets.com',
                'type' => 0,
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'User11',
                'username' => 'user11',
                'email' => 'user11@nicesnippets.com',
                'type' => 0,
                'password' => bcrypt('123456'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
