<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Learner;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DeleteLearnerInfoTest extends TestCase
{
    use DatabaseMigrations;

    public function test_learner_info_can_be_deleted()
    {
        //Create 10 learners
        Learner::factory()->count(10)->create();

        //Verify that exactly information of 10 learners were created
        $this->assertCount(10, Learner::all());

        //Delete the 10th learner's information
        $this->deleteJson('/api/learners/destroy/10');

        //Verify that only 9 learners information remains
        $this->assertCount(9, Learner::all());
    }
}
