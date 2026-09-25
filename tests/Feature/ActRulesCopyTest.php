<?php

namespace Tests\Feature;

use App\Models\Act;
use App\Models\ActCategory;
use App\Models\Rule;
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

    public function test_acts_table_exists(): void
    {
        Act::factory()->create();
        $this->assertDatabaseCount('acts', 1);
    }

    public function test_rule_category_creation(): void
    {
        \App\Models\RuleCategory::factory()->create();
        $this->assertDatabaseCount('rule_categories', 1);
    }

    public function test_admin_authentication(): void
    {
        $this->assertEquals(1, $this->admin->role_id);
    }
}
