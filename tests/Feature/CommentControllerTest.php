<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Post;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase;

    private int $post_id = 1;
    private User $user;


    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        Post::factory()->create([
            'id' => $this->post_id,
            'user_id' => $this->user->id,
        ]);
    }

    public function test_add_comment_returns_comment(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->post('/api/comment', [
            'post_id' => $this->post_id,
            'message' => 'message',
        ]);

        $response->assertStatus(201);
    }
}
