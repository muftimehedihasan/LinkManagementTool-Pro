<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LinksTableSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        DB::table('links')->insert([
            ['destination_url' => 'https://example1.com', 'short_url' => 'short1', 'tags' => 'example, test', 'click_count' => 120, 'user_id' => 1, 'created_at' => $now->subDays(6), 'updated_at' => $now],
            ['destination_url' => 'https://example2.com', 'short_url' => 'short2', 'tags' => 'sample, link', 'click_count' => 140, 'user_id' => 1, 'created_at' => $now->subDays(5), 'updated_at' => $now],
            ['destination_url' => 'https://example3.com', 'short_url' => 'short3', 'tags' => 'demo', 'click_count' => 180, 'user_id' => 2, 'created_at' => $now->subDays(4), 'updated_at' => $now],
            ['destination_url' => 'https://example4.com', 'short_url' => 'short4', 'tags' => 'test', 'click_count' => 100, 'user_id' => 1, 'created_at' => $now->subDays(3), 'updated_at' => $now],
            ['destination_url' => 'https://example5.com', 'short_url' => 'short5', 'tags' => 'example', 'click_count' => 200, 'user_id' => 2, 'created_at' => $now->subDays(2), 'updated_at' => $now],
        ]);
    }
}
