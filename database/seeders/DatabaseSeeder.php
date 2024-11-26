<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::factory(10) // Create 10 users
            ->has(\App\Models\Link::factory(10)) // Each user gets 10 links
            ->create();
    }
}
