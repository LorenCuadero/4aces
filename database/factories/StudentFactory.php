<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\Student;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'batch_year' => $this->faker->numberBetween(2010, 2021),
            'joined' => $this->faker->date('Y-m-d', '-4 years'),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}