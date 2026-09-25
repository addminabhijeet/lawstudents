<?php

namespace Database\Factories;

use App\Models\Act;
use App\Models\ActCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActFactory extends Factory
{
    protected $model = Act::class;

    public function definition(): array
    {
        return [
            'category_id' => ActCategory::factory(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'delete' => 1,
        ];
    }
}
