<?php

namespace Database\Factories;

use App\Models\Clientele;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteleFactory extends Factory
{
    protected $model = Clientele::class;

    public function definition(): array
    {
        return [
            'pdf' => 'clientele/' . $this->faker->uuid() . '.pdf',
            'description' => $this->faker->sentence(),
            'delete' => 1,
        ];
    }
}
