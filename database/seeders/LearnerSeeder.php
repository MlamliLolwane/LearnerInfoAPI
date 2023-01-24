<?php

namespace Database\Seeders;

use App\Models\Learner;
use Illuminate\Database\Seeder;

class LearnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create 50 learners
        Learner::factory()->count(25000)->create();
    }
}
