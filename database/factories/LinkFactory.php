<?php

namespace Database\Factories;

use App\Models\Link;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LinkFactory extends Factory
{
    protected $model = Link::class;

    public function definition()
    {
        return [
            'destination_url' => $this->faker->url,
            'short_url' => $this->faker->unique()->slug,
            'tags' => $this->faker->word,
            'click_count' => $this->faker->numberBetween(0, 100),
            
            'user_id' => User::factory(),
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),  // Added created_at
            'updated_at' => $this->faker->dateTimeBetween('-6 months', 'now'),  // Added updated_at
        ];
    }
}
