<?php

namespace Database\Seeders;

use App\Models\Learner;
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
        $this->call([
            LearnerSeeder::class
        ]);
    }
}
