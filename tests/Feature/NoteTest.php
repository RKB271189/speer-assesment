<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NoteTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    public function test_index()
    {
        $response = $this->json('GET', 'api/notes', ['Accept' => 'application/json']);
        $response->assertStatus(200);
    }
    public function test_note()
    {
        $noteid = 1;
        $response = $this->json('GET', 'api/notes/' . $noteid, ['Accept' => 'application/json']);
        $response->assertStatus(200);
    }
    public function test_save()
    {
        $params = [
            'user_id' => 1,
            'content' => 'This is test content for notes'
        ];
        $response = $this->json('POST', 'api/notes', $params, ['Accept' => 'application/json']);
        $response->assertStatus(200);
    }
    public function test_update()
    {
        $noteid = 1;
        $params = [
            'user_id' => 1,
            'content' => 'This is test content for notes update'
        ];
        $response = $this->json('PUT', 'api/notes/' . $noteid, $params, ['Accept' => 'application/json']);
        $response->assertStatus(200);
    }
    public function test_delete()
    {
        $noteid = 1;
        $response = $this->json('DELETE', 'api/notes/' . $noteid, ['Accept' => 'application/json']);
        $response->assertStatus(200);
    }
    public function test_share()
    {
        $noteid = 1;
        $userid = 2;
        $response = $this->json('POST', 'api/notes/' . $noteid . '/share', ['user_id' => $userid], ['Accept' => 'application/json']);
        $response->assertStatus(200);
    }
    public function test_search()
    {
        $query = 'test';
        $response = $this->json('GET', 'api/notes', ['q' => $query], ['Accept' => 'application/json']);
        $response->assertStatus(200)->assertJson(['notes']);
    }
}
