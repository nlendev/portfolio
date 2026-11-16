<?php

use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use Inertia\Testing\AssertableInertia as Assert;

test('a visitor can send a message', function () {
    Mail::fake();

    $this->post('/contact', [
        'name' => 'Awa Diallo',
        'email' => 'awa@example.com',
        'message' => 'Bonjour, votre quiz me plaît beaucoup.',
    ])
        ->assertRedirect('/contact')
        ->assertInertiaFlash('toast.message', 'Merci, votre message est bien parti.');

    expect(ContactMessage::count())->toBe(1);
    Mail::assertSent(ContactMessageReceived::class, fn ($mail) => $mail->hasReplyTo('awa@example.com'));
});

test('the contact form is validated', function () {
    Mail::fake();

    $this->post('/contact', ['name' => '', 'email' => 'pas-une-adresse', 'message' => ''])
        ->assertSessionHasErrors(['name', 'email', 'message']);

    Mail::assertNothingSent();

    test('the contact form is throttled', function () {
    Mail::fake();
    $data = ['name' => 'Awa', 'email' => 'awa@example.com', 'message' => 'Bonjour.'];

    $this->post('/contact', $data);
    $this->post('/contact', $data);
    $this->post('/contact', $data);

    $this->post('/contact', $data)
        ->assertTooManyRequests()
        ->assertInertia(fn (Assert $page) => $page->component('ErrorPage')->where('status', 429));
});

});
