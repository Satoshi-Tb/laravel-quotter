<?php

namespace Database\Seeders;

use App\Models\Quser;
use Illuminate\Database\Seeder;

class QuserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Quser::factory()->count(10)->create();
    }
}
