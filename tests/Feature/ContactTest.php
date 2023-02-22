<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_can_send_contact()
    { 
        $file = UploadedFile::fake()->image('attachment.png');

        $data = [
            'name' => 'John Doe',
            'email' => 'john@test.com',
            'message' => 'I am trying to send a contact message',
            'attachment' => $file,
        ];

        $response = $this->post('/api/v1/contact', $data);

        $response->assertStatus(200);

        $this->assertDatabaseCount('contacts',1);
    }


    public function test_cannot_send_contact_with_bad_form_data()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@test.com',
        ];

        $response = $this->post('/api/v1/contact', $data);

        $response->assertStatus(422);

    }
}
