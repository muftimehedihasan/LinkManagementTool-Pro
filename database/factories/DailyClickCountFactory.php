<?php
// database/factories/DailyClickCountFactory.php

namespace Database\Factories;

use App\Models\DailyClickCount;
use App\Models\Link;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class DailyClickCountFactory extends Factory
{
    protected $model = DailyClickCount::class;

    public function definition()
    {
        return [
            'link_id' => Link::factory(),
            'click_date' => $this->faker->date(),
            'click_count' => $this->faker->numberBetween(10, 100),
        ];
    }
}
