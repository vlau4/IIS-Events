<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 0
            ],
            [
                'name' => 'Manager',
                'email' => 'manager@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 1
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 2
            ]
        ];

        foreach($users as $user) {
            User::create($user);
        }

        $category = Category::factory()->create([
            'name' => 'food'
        ]);

        $location = Location::factory()->create([
            'street' => 'Kvetinkova',
            'number' => '22',
            'city' => 'Brno',
            'zip' => '60200'
        ]);

        Event::factory(6)->create([
            'user_id' => 3,
            'category_id' => $category->id,
            'location_id' => $location->id
        ]);
    }
}
