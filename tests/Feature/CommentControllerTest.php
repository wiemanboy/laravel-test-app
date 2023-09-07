<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Post;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Post::create([
            'id' => 1,
            'caption' => 'caption',
            'message' => 'message',
            'is_private' => false,
        ]);
    }

    public function test_add_comment_returns_comment(): void
    {
        $response = $this->post('/api/comment', [
            'postId' => 1,
            'message' => 'message',
        ]);

        $response->assertStatus(200);
    }
}
