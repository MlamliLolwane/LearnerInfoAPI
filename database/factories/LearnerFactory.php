<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LearnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $contact_id = 1;

        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->firstName(),
            'contact_id' => $contact_id++,
        ];
    }
}
