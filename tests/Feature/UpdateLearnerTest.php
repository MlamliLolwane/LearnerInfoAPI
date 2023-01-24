<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Learner;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateLearnerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_learner_information_can_be_sucessfully_updated()
    {
        //Clear the Learner table
        Learner::truncate();

        //Create a new learner from a factory
        Learner::factory()->create();

        //Verify that the learner was created
        $this->assertCount(1, Learner::all());

        //Update the newly created learner information
        $updatedLearner = ['first_name' => 'Jacob'];
 
        $response = $this->patchJson('/api/learners/update/1', $updatedLearner);
  
        //Assert that an update did happen
        $response->assertOk();
    }

    public function test_learner_information_cannot_be_updated_if_required_fields_are_set_to_null()
    {
        //Clear the Learner table
        Learner::truncate();

        //Create a new learner from a factory
        Learner::factory()->create();

        //Verify that the learner was created
        $this->assertCount(1, Learner::all());

        //Update the newly created learner information
        $response = $this->patchJson('/api/learners/update/1', [
            'first_name' => ' ',
            'last_name' => ' '
        ]);

        $response->assertInvalid(['first_name', 'last_name']);
    }
}
