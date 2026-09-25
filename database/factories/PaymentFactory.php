<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'student_id' => 1,
            'course_id' => '1',
            'amount' => $this->faker->numberBetween(500, 5000),
            'payment_status' => $this->faker->randomElement(['paid', 'pending']),
            'issue_date' => $this->faker->dateTime(),
        ];
    }
}
