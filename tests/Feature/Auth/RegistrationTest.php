<?php

test('registration screen can be rendered', function () {
    $response = $this->get('/register');
    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'cognome' => 'Test Cognome',              // AGGIUNTO
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'tipo_utente' => 'Visitatore',            // AGGIUNTO (o 'Guest')
        'accetta_termini' => true,                // AGGIUNTO
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('homepage', absolute: false));
});