<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Post;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_create_post_returns_post(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->post('/api/post', [
            'caption' => 'caption',
            'message' => 'message',
            'is_private' => false,
            'status' => 'active',
        ]);

        $response->assertStatus(201);
    }

    public function test_get_post_returns_post_with_comments(): void
    {
        $id = 1;

        Post::factory()->create(['id' => $id, 'user_id' => $this->user->id]);

        $response = $this->get('/api/post/' . $id);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'comments'
            ]);
    }

    public function test_update_post_returns_updated_post(): void
    {
        $id = 1;

        Post::factory()->create(['id' => $id, 'user_id' => $this->user->id]);

        $response = $this
            ->actingAs($this->user)
            ->put('/api/post/' . $id, [
            'caption' => 'caption',
            'message' => 'message',
            'is_private' => true,
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
        $id = 1;

        Post::factory()->create(['id' => $id, 'user_id' => $this->user->id]);

        $response = $this
            ->actingAs($this->user)
            ->delete('/api/post/' . $id);

        $response
            ->assertStatus(200)
            ->assertJson([
                'id' => $id,
            ]);

        $response = $this->get('/api/post/' . $id);
        $response->assertStatus(404);
    }

    public function test_non_owner_cannot_access_post(): void
    {
        $id = 1;

        $unauthorized_user = User::factory()->create();

        Post::factory()->create(['id' => $id, 'user_id' => $unauthorized_user->id]);

        $response = $this
            ->actingAs($this->user)
            ->delete('/api/post/' . $id);

        $response->assertStatus(403);
    }
}
