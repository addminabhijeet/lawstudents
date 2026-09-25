<?php

namespace Database\Factories;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryFactory extends Factory
{
    protected $model = Gallery::class;

    public function definition(): array
    {
        return [
            'image' => 'gallery/' . $this->faker->uuid() . '.jpg',
            'description' => $this->faker->sentence(),
            'group_name' => $this->faker->word(),
            'delete' => 1,
        ];
    }
}
