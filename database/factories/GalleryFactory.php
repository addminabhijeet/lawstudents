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
            'status' => true,
            'order' => $this->faker->numberBetween(1, 100),
        ];
    }
}
