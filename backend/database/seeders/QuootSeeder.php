<?php

namespace Database\Seeders;

use App\Models\Quoot;
use Illuminate\Database\Seeder;

class QuootSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Quoot::factory()->count(10)->create();
    }
}
