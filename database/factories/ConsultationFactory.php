<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consultation>
 */
class ConsultationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fullname' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'consult_date' => fake()->dateTime(),
            'phone_number' => fake()->phoneNumber(),
            'country' => fake()->country(),
            'state' => fake()->state(),
            'service_type' => fake()->word(),
        ];
    }
}
