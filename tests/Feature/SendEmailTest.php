<?php

namespace Tests\Feature;

use App\Mail\UserEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SendEmailTest extends TestCase
{
    /**
     * Test that an email is sent and logged in the database.
     *
     * @return void
     */
    public function test_email_is_sent_and_logged(): void
    {
        Mail::fake();

        $response = $this->post('/send', [
            'name'    => 'John Doe',
            'email'   => 'john@test.com',
            'content' => 'Hello World',
        ]);

        Mail::assertSent(UserEmail::class, function ($mail) {
            return $mail->hasTo('john@test.com');
        });

        $this->assertDatabaseHas('email_logs', [
            'content' => 'Hello World',
        ]);

        $response->assertRedirect();
    }
}
