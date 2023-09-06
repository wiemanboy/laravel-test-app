<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Post;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        Post::create([
            'id' => 100,
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
