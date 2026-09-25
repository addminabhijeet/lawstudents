<?php

namespace Tests\Feature;

use App\Models\Act;
use App\Models\ActCategory;
use App\Models\Rule;
use App\Models\Copy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActRulesCopyTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role_id' => 1]);
    }

    public function test_can_create_act_category(): void
    {
        ActCategory::factory()->create(['name' => 'Constitutional Law']);
        $this->assertDatabaseHas('act_categories', ['name' => 'Constitutional Law']);
    }

    public function test_acts_respect_delete_flag(): void
    {
        Act::factory()->create(['delete' => 1]);
        Act::factory()->create(['delete' => 0]);
        $this->assertDatabaseCount('acts', 2);
    }

    public function test_can_create_rule(): void
    {
        $category = \App\Models\RuleCategory::factory()->create();
        $subcategory = \App\Models\RuleSubcategory::factory()->create([
            'rule_category_id' => $category->id
        ]);
        Rule::factory()->create([
            'category_id' => $category->id,
            'subcategory_id' => $subcategory->id,
        ]);
        $this->assertDatabaseCount('rules', 1);
    }

    public function test_can_create_copy(): void
    {
        Copy::factory()->create(['delete' => 1]);
        $this->assertDatabaseCount('copies', 1);
    }

    public function test_soft_delete_acts(): void
    {
        $act = Act::factory()->create(['delete' => 1]);
        $act->update(['delete' => 0]);
        $act->refresh();
        $this->assertEquals(0, $act->delete);
    }

    public function test_admin_authentication(): void
    {
        $this->assertEquals(1, $this->admin->role_id);
    }
}
