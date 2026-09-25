<?php

namespace Tests\Feature;

use App\Models\ContactForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactFormFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_can_be_created(): void
    {
        ContactForm::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $this->assertDatabaseHas('contact_forms', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
    }

    public function test_contact_form_stores_message(): void
    {
        ContactForm::factory()->create([
            'message' => 'Test message content',
        ]);

        $this->assertDatabaseHas('contact_forms', [
            'message' => 'Test message content',
        ]);
    }
}
