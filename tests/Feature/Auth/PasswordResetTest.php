<?php

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('reset password link redirects to home', function () {
    $response = $this->get('/forgot-password');

    $response->assertRedirect('/');
});
