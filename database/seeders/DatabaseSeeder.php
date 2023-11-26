<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Event;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Location;
use App\Models\Attending;
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
            ],
            [
                'name' => 'Eric Smith',
                'email' => 'ericsmith@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 2
            ]
        ];

        foreach($users as $user) {
            User::create($user);
        }

        $categories = [
            [
                'name' => 'Music',
                'confirmed' => 1
            ],
            [
                'name' => 'Pop',
                'parent_id' => 1,
                'position'=> 1,
                'confirmed' => 1
            ],
            [
                'name' => 'Rap',
                'parent_id' => 1,
                'position'=> 1,
                'confirmed' => 1
            ],
            [
                'name' => 'Jazz',
                'parent_id' => 1,
                'position'=> 1,
                'confirmed' => 1
            ],
            [
                'name' => 'Technologies',
                'confirmed' => 1
            ],
            [
                'name' => 'Informatics',
                'parent_id' => 5,
                'position'=> 1,
                'confirmed' => 1
            ],
            [
                'name' => 'Robotics',
                'parent_id' => 6,
                'position'=> 2,
                'confirmed' => 1
            ],
            [
                'name' => 'Information Systems',
                'parent_id' => 6,
                'position'=> 2,
                'confirmed' => 1
            ],
            [
                'name' => 'Rocket Sience',
                'parent_id' => 5,
                'position'=> 1,
                'confirmed' => 1
            ]
        ];

        foreach($categories as $category) {
            Category::create($category);
        }

        $locations = [
            [
                'street' => 'Božetěchova',
                'number' => 1,
                'city' => 'Brno',
                'zip' => 61200,
                'country' => 'Česká republika',
                'confirmed' => 1
            ],
            [
                'street' => 'Čechomoravská',
                'number' => 17,
                'city' => 'Praha',
                'zip' => 19000,
                'country' => 'Česká republika',
                'confirmed' => 1
            ],
            [
                'street' => 'Botanická',
                'number' => 68,
                'city' => 'Brno',
                'zip' => 60200,
                'country' => 'Česká republika',
                'confirmed' => 1
            ]
        ];

        foreach($locations as $location) {
            Location::create($location);
        }

        $events = [
            [
                'title' => 'Laravel seminár',
                'category_id' => 8,
                'location_id' => 1,
                'user_id' => 4,
                'start' => '2023-10-24 08:00:00',
                'end' => '2023-10-27 18:00:00',
                'capacity' => '200',
                'entry_fee' => '200 kč',
                'tags' => 'backend, laravel, it',
                'description' => 'Semiár o základoch php framework-u Laravel a vytvorenie jednoduchého informačného systému.',
                'confirmed' => 1
            ],
            [
                'title' => 'Laravel seminár',
                'category_id' => 8,
                'location_id' => 3,
                'user_id' => 4,
                'start' => '2023-11-28 08:00:00',
                'end' => '2023-12-01 18:00:00',
                'capacity' => '200',
                'entry_fee' => '200 kč',
                'tags' => 'backend, laravel, it',
                'description' => 'Semiár o základoch php framework-u Laravel a vytvorenie jednoduchého informačného systému.',
                'confirmed' => 1
            ],
            [
                'title' => 'Ariana Grande',
                'category_id' => 2,
                'location_id' => 2,
                'user_id' => 4,
                'start' => '2023-10-30 19:00:00',
                'end' => '2023-10-30 22:00:00',
                'capacity' => '30 000',
                'entry_fee' => '2 500 kč',
                'tags' => 'pop, o2arena, concert',
                'description' => 'Koncert Ariany Grande v O2 aréne v Prahe.',
                'confirmed' => 1
            ],
            [
                'title' => 'Twenty One Pilots',
                'category_id' => 2,
                'location_id' => 2,
                'user_id' => 4,
                'start' => '2023-12-07 20:00:00',
                'end' => '2023-12-07 22:30:00',
                'capacity' => '30 000',
                'entry_fee' => '3 000 kč',
                'tags' => 'pop, rap, o2arena, concert',
                'description' => 'Koncert Twenty One Pilots v O2 aréne v Prahe.',
                'confirmed' => 1
            ]
        ];

        foreach($events as $event) {
            Event::create($event);
        }

        $attendings = [
            [
                'user_id' => 3,
                'event_id' => 3,
                'paid' => 1
            ],
            [
                'user_id' => 3,
                'event_id' => 4,
                'paid' => 1
            ],
            [
                'user_id' => 1,
                'event_id' => 1,
                'paid' => 1
            ],
            [
                'user_id' => 1,
                'event_id' => 2,
                'paid' => 0
            ],
            [
                'user_id' => 2,
                'event_id' => 1,
                'paid' => 1
            ]
        ];

        foreach($attendings as $attending) {
            Attending::create($attending);
        }

        $comments = [
            [
                'user_id' => 3,
                'event_id' => 3,
                'content' => 'This concert was really amazing! I will deffinitely go next time!'
            ],
            [
                'user_id' => 1,
                'event_id' => 1,
                'content' => 'It is not for beginners, I did not understand…'
            ],
            [
                'user_id' => 2,
                'event_id' => 1,
                'content' => 'Really informative seminar, it was worth it!'
            ]
        ];

        foreach($comments as $comment) {
            Comment::create($comment);
        }
    }
}
