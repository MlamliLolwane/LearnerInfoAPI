<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Learner;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class StoreLearnerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_learner_can_be_created_successfully()
    {
        //Send a valid request
        $this->postJson('/api/learners/store', [
            'first_name' => 'Mlamli',
            'last_name' => 'Lolwane'
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
            'first_name', 'last_name'
        ]);
    }
}
