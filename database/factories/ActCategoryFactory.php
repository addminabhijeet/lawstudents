<?php

namespace Database\Factories;

use App\Models\ActCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActCategoryFactory extends Factory
{
    protected $model = ActCategory::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
        ];
    }
}
