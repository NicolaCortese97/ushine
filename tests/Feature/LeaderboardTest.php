<?php

use App\Models\User;

test('guests are redirected to the login page from leaderboard', function () {
    $this->get('/leaderboard')->assertRedirect('/login');
});

test('authenticated users can visit the leaderboard', function () {
    $user = User::factory()->create([
        'tipo_utente' => 'Talent',
        'name' => 'John',
        'cognome' => 'Doe',
        'xp_points' => 120,
    ]);

    $this->actingAs($user);

    $response = $this->get('/leaderboard');
    $response->assertStatus(200);
    $response->assertSee('John Doe');
    $response->assertSee('120 XP');
});
