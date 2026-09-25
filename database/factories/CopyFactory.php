<?php

namespace Database\Factories;

use App\Models\Copy;
use Illuminate\Database\Eloquent\Factories\Factory;

class CopyFactory extends Factory
{
    protected $model = Copy::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'delete' => 1,
        ];
    }
}
