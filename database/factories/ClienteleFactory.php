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
            'description' => $this->faker->paragraph(),
            'pdfs' => json_encode(['pdf' => 'clientele/' . $this->faker->uuid() . '.pdf']),
        ];
    }
}
