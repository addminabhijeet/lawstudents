<?php

namespace Database\Factories;

use App\Models\CourseNote;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseNoteFactory extends Factory
{
    protected $model = CourseNote::class;

    public function definition(): array
    {
        return [
            'course_id' => 1,
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'is_free' => $this->faker->boolean(),
            'status' => 1,
        ];
    }
}
