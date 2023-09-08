<?php

use App\Models\Comment;
use PHPUnit\Framework\TestCase;

class CommentTest extends TestCase
{
    public function test_isAppropriate_returns_false_when_message_contains_bad_word(): void
    {
        $comment = new Comment(['message' => 'This is a bad message']);

        $this->assertFalse($comment->isAppropriate());
    }

    public function test_isAppropriate_returns_true_when_message_is_appropriate(): void
    {
        $comment = new Comment(['message' => 'This is a good message']);

        $this->assertTrue($comment->isAppropriate());
    }
}
