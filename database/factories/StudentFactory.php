<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\Student;

class StudentFactory extends Factory {
    protected $model = Student::class;

    public function definition() {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'middle_name' => $this->faker->randomLetter,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'birthdate' => $this->faker->dateTimeBetween( '-30 years', '-18 years' )->format( 'Y-m-d' ),
            'address' => $this->faker->address,
            'parent_name' => $this->faker->name( 'male' ),
            'parent_contact' => $this->faker->phoneNumber,
            'payable_status' => $this->faker->randomElement( [ 'paid', 'unpaid' ] ),
            'account_status' => $this->faker->randomElement( [ 'active', 'closed' ] ),
            'batch_year' => $this->faker->numberBetween( 2010, 2021 ),
            'joined' => $this->faker->date( 'Y-m-d', '-4 years' ),
            'status' => $this->faker->randomElement( [ 'active', 'inactive' ] )
        ];
    }
}