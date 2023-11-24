<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Attending;
use App\Models\User;
use App\Models\Event;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'John User',
                'email' => 'user@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 0
            ],
            [
                'name' => 'Thomas Manager',
                'email' => 'manager@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 1
            ],
            [
                'name' => 'Simone Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 2
            ]
        ];

        foreach($users as $user) {
            User::create($user);
        }

        // $categories = [
        //     [
        //         'name' = 'Music'
        //         ]
        // ]

        for($i = 1; $i <= 3; $i++) {
            $category = Category::factory()->create();
            $location = Location::factory()->create();
            Event::factory(2)->create([
                'user_id' => $i,
                'category_id' => $category->id,
                'location_id' => $location->id
            ]);
        }
    }
}
