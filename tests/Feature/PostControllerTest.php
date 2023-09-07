<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Post;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_post_returns_post(): void
    {
        $response = $this->post('/api/post', [
            'caption' => 'caption',
            'message' => 'message',
            'isPrivate' => false,
            'status' => 'active',
        ]);

        $response->assertStatus(201);
    }

    public function test_get_post_returns_post_with_comments(): void
    {
        Post::create([
            'id' => 1,
            'caption' => 'caption',
            'message' => 'message',
            'is_private' => false,
        ]);

        $response = $this->get('/api/post/1');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'comments'
            ]);
    }

    public function test_update_post_returns_updated_post(): void
    {
        Post::create([
            'id' => 1,
            'caption' => 'caption',
            'message' => 'message',
            'is_private' => false,
        ]);

        $response = $this->put('/api/post/1', [
            'caption' => 'caption',
            'message' => 'message',
            'isPrivate' => true,
            'status' => 'active',
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'is_private' => true,
            ]);
    }

    public function test_delete_post_returns_deleted_post(): void
    {
        Post::create([
            'id' => 1,
            'caption' => 'caption',
            'message' => 'message',
            'is_private' => false,
        ]);

        $response = $this->delete('/api/post/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                'id' => 1,
            ]);

        $response = $this->get('/api/post/1');
        $response->assertStatus(404);
    }
}
