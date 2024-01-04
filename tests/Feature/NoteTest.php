<?php

namespace Tests\Feature;

use App\Models\Note;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
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
    public function test_unauthorized_access()
    {
        $response = $this->json('GET', 'api/notes', ['Accept' => 'application/json']);
        $response->assertStatus(401);
    }
    public function test_index()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $response = $this->json('GET', 'api/notes', ['Accept' => 'application/json']);
        $response->assertStatus(200);
    }
    public function test_note()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $note = Note::factory()->create();
        $response = $this->json('GET', 'api/notes/' . $note->id, ['Accept' => 'application/json']);
        $response->assertStatus(200);
    }
    public function test_save()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $params = [
            'user_id' => 1,
            'content' => 'This is test content for notes'
        ];
        $response = $this->json('POST', 'api/notes', $params, ['Accept' => 'application/json']);
        $response->assertStatus(200);
    }
    public function test_update()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $note = Note::factory()->create();
        $params = [
            'content' => 'This is test content for notes update'
        ];
        $response = $this->json('PUT', 'api/notes/' . $note->id, $params, ['Accept' => 'application/json']);
        $response->assertStatus(200);
    }
    public function test_delete()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $note = Note::factory()->create();
        $response = $this->json('DELETE', 'api/notes/' . $note->id, ['Accept' => 'application/json']);
        $response->assertStatus(200);
    }
    public function test_share()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $note = Note::factory()->create();
        $user = User::factory()->create();
        $userid = $user->id;
        $response = $this->json('POST', 'api/notes/' . $note->id . '/share', ['user_id' => $userid], ['Accept' => 'application/json']);
        $response->assertStatus(200);
    }
    public function test_search()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $query = 'test';
        $response = $this->json('GET', 'api/notes', ['q' => $query], ['Accept' => 'application/json']);
        $response->assertStatus(200);
    }
}
