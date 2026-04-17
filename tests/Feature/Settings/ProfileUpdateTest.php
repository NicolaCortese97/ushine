<?php

use App\Models\User;

test('profile page is displayed', function () {
    $this->actingAs(User::factory()->create());
    $this->get('/settings/profile')->assertOk();
});

test('profile information can be updated', function () {
    $user = User::factory()->create();
    $originalEmail = $user->email;

    $response = $this
        ->actingAs($user)
        ->put('/settings/profile', [
            'name' => 'Test User',
            'cognome' => 'Test Cognome',
            'bio' => 'Bio di test',
            'email' => $originalEmail,
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/settings/profile');

    $user->refresh();

    expect($user->name)->toBe('Test User');
    expect($user->cognome)->toBe('Test Cognome');
    expect($user->bio)->toBe('Bio di test');
    expect($user->email)->toBe($originalEmail);
});

test('email verification status is unchanged when email address is unchanged', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->put('/settings/profile', [
            'name' => 'Test User',
            'cognome' => 'Test Cognome',
            'bio' => 'Bio di test',
            'email' => $user->email,
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/settings/profile');

    expect($user->refresh()->email_verified_at)->not->toBeNull();
});

test('user can delete their account', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->delete('/settings/profile');

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/');

    $this->assertGuest();
    expect($user->fresh())->toBeNull();
});
