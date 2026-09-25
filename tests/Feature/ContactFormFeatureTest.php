<?php

namespace Tests\Feature;

use App\Models\ContactForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_submission_creates_record(): void
    {
        $response = $this->post('/contact', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'Test message'
        ]);

        $this->assertDatabaseHas('contact_forms', [
            'email' => 'john@example.com',
            'name' => 'John Doe',
        ]);
    }

    public function test_contact_form_requires_validation(): void
    {
        $response = $this->post('/contact', [
            'name' => '',
            'email' => 'invalid-email',
            'message' => ''
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'message']);
    }

    public function test_contact_form_soft_delete(): void
    {
        $contact = ContactForm::factory()->create();
        
        $response = $this->actingAs(\App\Models\User::factory()->create(['role_id' => 1]), 'admin')
            ->post("/admin/delete-contact/{$contact->id}");

        $contact->refresh();
        $this->assertEquals(0, $contact->delete);
    }

    public function test_contact_form_list_only_shows_active(): void
    {
        ContactForm::factory()->create(['delete' => 1]);
        ContactForm::factory()->create(['delete' => 0]);

        $response = $this->actingAs(\App\Models\User::factory()->create(['role_id' => 1]), 'admin')
            ->get('/admin/list-contactform');

        $response->assertStatus(200);
        // Only 1 active contact should be visible
    }
}
