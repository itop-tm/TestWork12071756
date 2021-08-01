<?php

namespace Tests\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_it_can_register_user_by_phone_test()
    {
        $response = $this->postJson('auth/sign-up', [
            'phone_number' => 99362615986,
            'firstname' => 'Mohamed',
            'lastname'  => 'Hojayev'
        ]);

        $response->dump();

        $response->assertStatus(201);
    }

    public function test_user_can_login_test()
    {
        $response = $this->postJson('auth/sign-in', [
            'phone_number' => 99362615986,
            'otp' => 12345,
        ]);

        $response->dump();

        $response->assertStatus(200);
    }
   
    public function test_user_can_request_verification_code()
    {
        $response = $this->postJson('auth/send-otp', [
            'phone_number' => 99362615986
        ]);

        $response->dump();

        $response->assertStatus(200);
    }

    public function test_user_can_logout_test()
    {
        $response = $this->withHeaders([
            'Authorization' => "Bearer {$this->userToken}",
        ])
        ->postJson('auth/logout');

        $response->dump();

        $response->assertStatus(200);
    }
}
