<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function addComment(Request $request)
    {
        $comment = new Comment(['message' => $request->input('message')]);

        if (!$comment->isAppropriate()) {
            return response()->json(['message' => 'Comment is not appropriate'], 400);
        }

        $post = Post::findOrFail($request->input('postId'));

        $post->addComment($comment);

        return $comment;
    }
}
