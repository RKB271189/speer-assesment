<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    public function test_auth_valid()
    {
        $params = [
            'email' => 'test@gmail.com',
            'password' => 'password'
        ];
        $response = $this->json('POST', 'api/auth/login', $params, ['Accept' => 'application/json']);
        $response->assertStatus(200);
    }
    public function test_auth_invalid()
    {
        $params = [
            'email' => 'test@gmail.com',
            'password' => 'password'
        ];
        $response = $this->json('POST', 'api/auth/login', $params, ['Accept' => 'application/json']);
        $response->assertStatus(401);
    }
    public function test_create_user()
    {
        $params = [
            'name' => 'john doe',
            'email' => 'test@gmail.com',
            'password' => 'password'
        ];
        $response = $this->json('POST', 'api/auth/signup', $params, ['Accept' => 'application/json']);
        $response->assertStatus(200);
    }
}
