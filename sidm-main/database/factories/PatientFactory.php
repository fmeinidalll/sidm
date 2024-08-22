<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'dob' => $this->faker->date,
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'age' => $this->faker->numberBetween(18, 90),
            'weight' => $this->faker->randomFloat(2, 40, 120),
            'address' => $this->faker->address,
            'phone_number' => $this->faker->phoneNumber,
            'occupation' => $this->faker->jobTitle,
            'user_id' => null, // Jika ada user_id yang sesuai, gantilah nilainya
        ];
    }
}
