<?php

namespace Database\Seeders;

use App\Models\Rack;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Rack::factory()->create([
            'code' => 'Receiving Area',
            'note' => 'Temporary place before sorted on rack',
        ]);
    }
}
