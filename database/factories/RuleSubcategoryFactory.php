<?php

namespace Database\Factories;

use App\Models\RuleSubcategory;
use App\Models\RuleCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class RuleSubcategoryFactory extends Factory
{
    protected $model = RuleSubcategory::class;

    public function definition(): array
    {
        return [
            'rule_category_id' => RuleCategory::factory(),
        ];
    }
}
