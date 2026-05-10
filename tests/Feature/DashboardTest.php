<?php

use App\Models\User;

test('guests are redirected to the login page', function () {
    $this->get('/profileInfo')->assertRedirect('/login');
});

test('authenticated users can visit the profileInfo', function () {
    $this->actingAs($user = User::factory()->create());

    $this->get('/profileInfo')->assertStatus(200);
});