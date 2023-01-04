<?php

namespace Tests\Feature;

use App\Models\Learner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreLearnerTest extends TestCase
{
    use RefreshDatabase;

    public function test_learner_can_be_created_successfully()
    {
        //Delete everything in the learner table
        Learner::truncate();

        //Send a valid request
        $this->postJson('/api/learners/store', [
            'first_name' => 'Mlamli',
            'last_name' => 'Lolwane',
            'contact_id' => 1
        ]);

        //Assert that the record was created in the database
        $this->assertCount(1, Learner::all());
    }

    public function test_learner_cannot_be_stored_without_any_of_the_required_fields_supplied()
    {
        //Send a request with the missing required fields
        $response = $this->postJson('/api/learners/store');

        //Assert that the request was invalid as it was missing the required fields
        $response->assertInvalid([
            'first_name', 'last_name', 'contact_id'
        ]);
    }
}
