<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'start' => $this->faker->date(),
            'end' => $this->faker->date(),
            'tags' => 'festival, music, pop',
            'description' => $this->faker->paragraph(5),
            'capacity' => 'unlimited',
            'entry_fee' => 'free',
            'confirmed' => 1
        ];
    }
}
