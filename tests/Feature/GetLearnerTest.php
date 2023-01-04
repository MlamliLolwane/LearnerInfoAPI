<?php

namespace Tests\Feature;

use App\Models\Learner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetLearnerTest extends TestCase
{
    public function test_information_for_all_the_learners_can_be_retrieved_from_the_database()
    {
        Learner::truncate();

        //Create 50 learners 
        Learner::factory()->count(50)->create();

        //Get information for all the learners 
        $response = $this->getJson('/api/learners/index');

        //Assert that 15 records were retrieved because of the pagination
        $response->assertJsonCount(15, 'data');
    }

    public function test_that_only_the_information_of_the_specified_learner_can_be_retrieved()
    {
        Learner::truncate();

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
         //Delete all learners
         Learner::truncate();

         //Store 10 learners on the database
         Learner::factory(10)->create();

         //Fetch a learner with an invalid id
        $learner = $this->getJson('/api/learners/show/11');

        $learner->assertStatus(404);
    }   
}
