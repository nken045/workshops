<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Workshop;

class WorkshopTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Workshop::factory()->count(30)->create();
    }
}
