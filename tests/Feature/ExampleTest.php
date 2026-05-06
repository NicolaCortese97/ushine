<?php

test('the application redirects to landing', function () {
    $response = $this->get('/');

    $response->assertRedirect(route('landing'));
});
