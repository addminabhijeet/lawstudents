<?php

namespace Database\Factories;

use App\Models\StudentAdmission;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentAdmissionFactory extends Factory
{
    protected $model = StudentAdmission::class;

    public function definition(): array
    {
        return [
            'student_id' => 1,
            'admission_status' => $this->faker->randomElement(['approved', 'pending', 'rejected']),
            'admission_date' => $this->faker->dateTime(),
            'deleted' => 0,
        ];
    }
}
