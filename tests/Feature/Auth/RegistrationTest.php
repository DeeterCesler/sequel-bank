<?php

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('registration screen redirects to home', function () {
    $response = $this->get('/register');

    $response->assertRedirect('/');
});
