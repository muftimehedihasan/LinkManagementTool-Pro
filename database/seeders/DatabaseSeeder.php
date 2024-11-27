<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Link;
use App\Models\ClickHistory;
use App\Models\DailyClickCount;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::factory(10) // 10 users
            ->has(
                \App\Models\Link::factory(10) // Each user gets 10 links
                    ->has(\App\Models\ClickHistory::factory(5)) // Each link gets 5 click histories
                    ->has(DailyClickCount::factory()->count(7)) // Each link gets 7 daily click counts
            )
            ->create();
    }
}
