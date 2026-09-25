<?php

namespace Database\Factories;

use App\Models\Rule;
use App\Models\RuleCategory;
use App\Models\RuleSubcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class RuleFactory extends Factory
{
    protected $model = Rule::class;

    public function definition(): array
    {
        $category = RuleCategory::factory()->create();
        return [
            'category_id' => $category->id,
            'subcategory_id' => RuleSubcategory::factory()->create(['rule_category_id' => $category->id]),
            'description' => $this->faker->paragraph(),
            'delete' => 1,
        ];
    }
}
