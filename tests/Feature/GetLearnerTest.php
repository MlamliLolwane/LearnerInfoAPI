<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Learner;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class GetLearnerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_information_for_all_the_learners_can_be_retrieved_from_the_database()
    {
        //Create 50 learners 
        Learner::factory()->count(50)->create();

        //Get information for all the learners 
        $this->getJson('/api/learners/index');

        $this->assertCount(50, Learner::all());
    }

    public function test_that_only_the_information_of_the_specified_learner_can_be_retrieved()
    {
        //Create 14 learners (Pagination...)
        Learner::factory()->count(14)->create();

        //Create the 15th learner

        Learner::factory()->create([
            'first_name' => 'Mlamli',
            'last_name' => 'Lolwane'
        ]);

        //Get and verify the 15th learner information
        $response = $this->getJson('/api/learners/show/15');

        $response->assertJson([
            'first_name' => 'Mlamli',
            'last_name' => 'Lolwane'
        ]);
    }

    //Test that no learner is returned when an invalid id is provided
    public function test_that_invalid_id_provided_results_in_not_found()
    {
         //Store 10 learners on the database
         Learner::factory(10)->create();

         //Fetch a learner with an invalid id
        $learner = $this->getJson('/api/learners/show/11');

        $learner->assertStatus(404);
    }   
}
