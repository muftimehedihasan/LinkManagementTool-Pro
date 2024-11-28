<?php

namespace Database\Factories;

use App\Models\ClickHistory;
use App\Models\Link;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClickHistoryFactory extends Factory
{
    protected $model = ClickHistory::class;

    public function definition(): array
    {
        return [
            'link_id' => Link::factory(), // Associate with a Link
            // 'user_id' => User::factory(), // Optionally associate with a User
            'ip_address' => $this->faker->ipv4(),
            'clicked_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
        ];
    }
}
